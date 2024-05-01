# Estágio de desenvolvimento
FROM node:18.16-alpine as dev-stage
WORKDIR /app

# Copie os arquivos package.json e package-lock.json para o diretório de trabalho
COPY package*.json ./

# Instale o Vue CLI globalmente e atualize o npm
RUN npm install -g @vue/cli && npm update --no-cache

# Copie todo o restante do projeto para o diretório de trabalho
COPY . .

# Comando para iniciar o aplicativo com live reload
CMD ["npm", "run", "serve"]
