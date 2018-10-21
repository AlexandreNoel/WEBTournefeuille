#!/bin/bash

set -e

echo -e "$PRIVATE_KEY" > /root/.ssh/id_rsa
chmod 600 /root/.ssh/id_rsa

touch ~/.ssh/config
echo -e "Host *\n\tStrictHostKeyChecking no\n\n" >> ~/.ssh/config

ssh ec2-user@${server} 'bash' < ./updateMaster.sh