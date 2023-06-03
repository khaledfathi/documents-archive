#!/bin/bash
./phpDocumentor.phar project:run -d \
"app/Http/Controllers/",\
"app/Http/Requests/",\
"app/Repository/",\
"app/Enum/User/",\
"app/constants.php",\
"app/Providers/RepositoryServiceProvider.php",\
"app/constants.php",\
"app/Rules/"\
 -t public/docs
