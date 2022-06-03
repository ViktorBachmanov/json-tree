## Json-Tree

Раскрывающийся список на основе json-файла

## Nginx

```
server {
listen 80;
listen [::]:80;
server_name json-tree;
root /any_path/json-tree/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

}
```

## Log in

Name: Ivan
Password: 123

## Json file

Исходный json-file должен находиться по адресу storage/app/source.json

Пример:

```{
    "leaf-0": "firstLeaf",
    "node-1": {
        "leaf-1": "value-1"
    },
    "node-2": {
        "leaf-1": "value-1",
        "leaf-2": 0,
        "leaf-3": true,
        "node-3": {
            "leaf-1": "str-1",
            "leaf-2": 12.5,
            "node-4": {
                "leaf-1": "str-2",
                "leaf-2": 5,
                "leaf-3": false
            }
        }
    }
}
```
