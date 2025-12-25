# docker run -d -p 8800:8080 jenkins/jenkins:lts
#running jenkins dan bagiin images yang sudah dibuat tadi, 
#jadinya di mount dikarenakan jika copy image beberapa file akan hilang seperti artisan dan lain-lain
#sehingga akan dilakukan mount untuk menghindari hilangnya file penting
docker run -d -p 8800:8080   --name jenkins-saas   -v /var/run/docker.sock:/var/run/docker.sock   -v $(which docker):/usr/bin/docker   -v /home/lili/cloudcomputing-fp/saas-ticketing:/var/jenkins_home/workspace/Ticketing\ help\ desk   jenkins/jenkins:lts

#cek apakah file sudah lengkap dan tidak ada yang hilang
docker exec jenkins-saas ls -la "/var/jenkins_home/workspace/Ticketing help desk"

#untuk lihat password
docker exec -it jenkins-saas cat /var/jenkins_home/secrets/initialAdminPassword