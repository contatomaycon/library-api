# Library API

Back-end da API do sistema de Library

## Siga os passos:

### Rode o docker compose
Na raiz do projeto faça o seguinte comando para iniciar o serviço:

```
sudo docker-compose up -d
```

### Rode as migrates
```
sudo docker exec -it php_library php spark migrate
```

### Rode os seeds
```
sudo docker exec -it php_library php spark db:seed DatabaseSeeder
```

## Tecnologias utilizadas:
- Docker
- Redis
- Mysql
- Codeigniter 4
