#!/bin/bash
command="$1";
alias="$2";
if [ "$command" == "up" ]; then
    docker compose up -d $alias
elif [ "$command" == "down" ]; then
    docker compose down
elif [ "$command" == "bash" ]; then
    docker exec -it server bash
elif [ "$command" == "composer" ]; then
    if [ "$alias" == "init" ]; then
        docker exec server composer init --description '' --no-interaction
    else
        docker exec server composer $alias $3
    fi
elif [ "$command" == "dump" ]; then
    docker exec -it mysql /dumpdb
fi