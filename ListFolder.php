<?php
// for debugging
ini_set("display_errors", 1);
// Authenticate and pick up Calendar object
require_once("AuthorizeDriveFusion.php");

/**
 * Retrieve a list of File resources in a folder shared with the service account.
 *
 * @param Google_DriveService $service Drive API service instance.
 * @return Array List of Google_DriveFile resources.
 */
function retrieveAllFiles($service) {
  $result = array();
  $pageToken = NULL;

  do {
    try {
      $parameters = array();
// query for files in this folder
      $parameters['q'] = "'0B6a7ubBDa-1YaFpkSS1zLUltSlU' in parents";
      if ($pageToken) {
        $parameters['pageToken'] = $pageToken;
      }
      $files = $service->files->listFiles($parameters);
      $result = array_merge($result, $files->getItems());
      $pageToken = $files->getNextPageToken();
    } catch (Exception $e) {
      print "An error occurred: " . $e->getMessage();
      $pageToken = NULL;
    }
  } while ($pageToken);
  return $result;
}
$result = retrieveAllFiles($DriveService);
echo count($result);
foreach ($result as $item){
    var_dump($item);
    $FileId = $item['id'];
    echo "id is: $FileId\n";
    echo "title is: ", $item['title'], "\n";
    echo "webContentLink is : ", $item['webContentLink'], "\n";
    $file = $DriveService->files->get($FileId); 
    echo "Attempt to get thumbnail: ";
    var_dump($file->getThumbnailLink());
    if (isset($file['thumbnailLink']))
        echo "thumbnailLink is: " , $file['thumbnailLink'], "\n";
    echo "lastModifyingUserName is : ", $item['lastModifyingUserName'], "\n";
    if (isset($item['imageMediaMetadata'])) {
      $Meta = $item['imageMediaMetadata'];
      if (isset($Meta)){
        echo "latitude is: ",
           $Meta['location']['latitude'], "\n";
        echo "longitude is: ",
           $Meta['location']['longitude'], "\n";
       }
       if (isset($Meta['date']))
        echo "date is: ", $Meta['date'], "\n";
        // otherwise set date from file?
    }
}
?>
