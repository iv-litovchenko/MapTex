FROM nginx:1.22

# Устанавливаем стадии
USER root
ARG user=appuser
ARG group=appuser
ARG uid=1000
ARG gid=1000
RUN groupadd -g ${gid} ${group}
RUN useradd -u ${uid} -g ${group} -s /bin/sh -m ${user} # <--- the '-m' create a user home directory

WORKDIR /var/www/html
RUN chown ${group}:${user} -R .
RUN chmod -R 777 .
# USER ${uid}:${gid}
