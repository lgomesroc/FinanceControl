# Usar a imagem oficial do Node.js mais recente LTS
FROM node:20-alpine

# Definir o diretório de trabalho no container
WORKDIR /usr/src/app

# Copiar os arquivos de dependência e instalar
COPY package*.json ./
RUN npm install

# Copiar o restante do código da aplicação
COPY . .

# Construir a aplicação
RUN npm run build

# Expor a porta que o aplicativo React vai rodar
EXPOSE 3000

# Comando para rodar a aplicação
CMD ["npm", "start"]