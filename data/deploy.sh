#!/bin/bash

set -e

mkdir -p ~/.ssh
touch ~/.ssh/id_rsa
echo -e "$PRIVATE_KEY" > ~/.ssh/id_rsa
chmod 600 ~/.ssh/id_rsa

touch ~/.ssh/config
echo -e "Host *\n\tStrictHostKeyChecking no\n\n" >> ~/.ssh/config

ssh ec2-user@${server} 'bash' < ./data/updateMaster.sh
