<?php

function readComposer()
{
    // dd(base_path('composer.json'));
    $composer = json_decode(file_get_contents(base_path('composer.json')));
    return $composer;
}

function fetchFromRemote()
{
    $name = readComposer()->name;
    $userAgent = 'Uspdev versioning agent';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://apis.github.com/repos/$name/releases/latest");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);

    $res = curl_exec($ch);
    curl_close($ch);

    if (json_decode($res)) {
        file_put_contents(storage_path('app/latest-release.json'), $res);
    }

}

function get_latest_release()
{
    fetchFromRemote();
    $latest = file_get_contents(storage_path('app/latest-release.json'));
    $latest = json_decode($latest);

    echo $latest->tag_name, PHP_EOL;
    echo $latest->published_at, PHP_EOL;

    // var_dump($latest);

    /* not found message
{
"message": "Not Found",
"documentation_url": "https://docs.github.com/rest/reference/repos#get-the-latest-release"
}
 */
}

# Usage
# $ get_latest_release "creationix/nvm"
# v0.31.4
