<?php
/**
 * Extaz-CMS - UpdateController.php
 * Coded by TristanCode
 * Created: 10/30/15 at 8:52 PM
 */

class UpdateController extends AppController {
    public function admin_index() {
        if ($this->Auth->user('role') > 1) {
            $cms_version = Configure::read('cms.version');
            $cms_current_version = Configure::read('cms.current_version');

                if ($cms_version != $cms_current_version) {
                    //Format : @_path_filename.type.txt
                    $server = file_get_contents("http://extaz-cms.fr/updates/index.php");
                    $files = json_decode($server);

                    foreach ($files as $file) {
                        if (preg_match("/(@\w+)/u", $file)) {
                            $file_contents = file_get_contents("http://extaz-cms.fr/updates/$file");
                            $file = preg_replace("/@/", "", $file);

                            $file_name = preg_replace("/(_(.*)_)/u", "", $file);
                            $file_name = preg_replace("/.txt/u", "", $file_name);

                            $file_type = preg_replace("/(\w+\.)/u", "", $file_name);
                            $file_type = preg_replace("/.txt/u", "", $file_type);

                            $file_directory = preg_split("/_/u", $file);
                            $file_directory = $file_directory[1];
                            $file_directory = preg_replace("/-/", "/", $file_directory);
                            $file_directory = ROOT . $file_directory;

                            if ($file_type != "sql") {
                                if (file_exists($file_directory)) {
                                    $make_file = fopen($file_directory . $file_name, "w");
                                    fwrite($make_file, $file_contents);
                                    fclose($make_file);
                                } else {
                                    mkdir($file_directory);
                                    $make_file = fopen($file_directory . $file_name, "w");
                                    fwrite($make_file, $file_contents);
                                    fclose($make_file);
                                }
                            } else {
                                $db = ConnectionManager::getDataSource('default');
                                $db->rawQuery($file_contents);
                            }
                        }
                    }
                    $this->Session->setFlash('Le cms a été mis à jour!', 'toastr_success');
                    return $this->redirect(['controller' => 'update', 'action' => 'index', 'admin' => true]);
                }
            } else {
            throw new NotFoundException();
        }
    }
}