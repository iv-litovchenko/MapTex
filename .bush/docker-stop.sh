docker stop $(docker ps -a -q) # остановить все процессы
docker rm $(docker ps -a -q) # удалить все процессы
