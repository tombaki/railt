#!/usr/bin/env bash
git subsplit init git@github.com:railt/railt.git
git subsplit publish --heads="master" --no-tags src/Railt/Container:git@github.com:railt/container.git
git subsplit publish --heads="master" --no-tags src/Railt/Http:git@github.com:railt/http.git
git subsplit publish --heads="master" --no-tags src/Railt/Compiler:git@github.com:railt/compiler.git
git subsplit publish --heads="master" --no-tags src/Railt/Routing:git@github.com:railt/routing.git
git subsplit publish --heads="master" --no-tags src/Railt/Events:git@github.com:railt/events.git
rm -rf .subsplit/
