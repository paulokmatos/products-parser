# Product Parser API

Esta API permite Armazenar, Ler e Atualizar informações vindas do Open Food Facts.

## Tecnologias

- Linguagem: PHP
- Framework: Laravel
- Banco de Dados: Postgres, Redis
- Ferramentas: Git, Composer, Docker

## Siga as instruções abaixo para instalar e usar o projeto usando o Docker:


1. Clone o repositório do projeto:

    ```bash
    git clone https://github.com/paulokmatos/products-parser.git
    ```

2. Navegue até o diretório do projeto:

    ```bash
    cd products-parser/back-end
    ```
3. Copie o arquivo .env.example para .env:

    ```bash
        cp .env.example .env
    ```

4. Configure as informações de conexão com o banco de dados no arquivo .env.

5. Inicie o ambiente Docker:

    ```bash
    docker-compose up -d
    ```
6. Execute as migrações do banco de dados:

    ```bash
    docker-compose exec app php artisan migrate
    ```
7. Importe os dados do OpenFoodFacts:

    ```bash
    docker-compose exec app php artisan import:openfoodfacts
    ```
8. Execute a fila Redis para criar os produtos:

    ```bash
    docker-compose exec app php artisan queue:work redis --queue=create_products
    ```
9. Acesse a API em http://localhost:8000.

## Documentação

### Listar produtos

Retorna uma lista paginada de produtos.

**Endpoint**: `GET /api/products`

**Parâmetros de consulta opcionais**:

- `limit`: Define o número máximo de produtos por página (padrão: 20)
- `offset`: Define o deslocamento para a página desejada (padrão: 0)

**Resposta de exemplo**:

```json
[
	{
		"id": 1,
		"code": "168069605",
		"status": "published",
		"imported_t": "2023-06-30 03:59:03",
		"url": "http:\/\/www.mascarenhas.net.br\/",
		"creator": "Alana Gabrielle Ferreira Neto",
		"created_t": 1236305549,
		"last_modified_t": 673991262,
		"product_name": "Molestiae rem neque dolor dolore veritatis quos illo.",
		"quantity": "12597",
		"brands": "de Freitas e Associados",
		"categories": "nulla dolor consequuntur aut porro",
		"labels": "quia nihil enim",
		"cities": "Brito do Leste",
		"purchase_places": "Santa Melina d'Oeste, Turcomenistão",
		"stores": "Neves Ltda.",
		"ingredients_text": "Dolores recusandae voluptas quam in hic odit maxime. Et numquam perspiciatis quaerat maxime minus necessitatibus quo animi. Cum omnis fugiat blanditiis rem quo. Quia saepe quos id deserunt.",
		"traces": "minus ut veritatis aut recusandae",
		"serving_size": "200g",
		"serving_quantity": "5.09",
		"nutriscore_score": 5,
		"nutriscore_grade": "A",
		"main_category": "category1",
		"image_url": "https:\/\/via.placeholder.com\/640x480.png\/003388?text=ex",
		"created_at": "2023-06-15T03:59:05.000000Z",
		"updated_at": "2023-06-15T03:59:05.000000Z"
	},
	{
		"id": 2,
		"code": "632999468",
		"status": "draft",
		"imported_t": "2023-06-30 03:59:03",
		"url": "https:\/\/www.arruda.com.br\/sed-id-aut-voluptatem-optio",
		"creator": "Mel Delvalle Caldeira",
		"created_t": 626059537,
		"last_modified_t": 293196440,
		"product_name": "Accusamus qui exercitationem eaque aut.",
		"quantity": "7502",
		"brands": "de Oliveira e Associados",
		"categories": "est odit exercitationem non magnam",
		"labels": "qui magnam et",
		"cities": "Diego d'Oeste",
		"purchase_places": "Alexandre do Leste, Portugal",
		"stores": "Valdez Comercial Ltda.",
		"ingredients_text": "Et aut omnis iusto sit optio. Consequatur voluptatem excepturi sit perferendis sit molestiae. Ullam eum iste ut explicabo.",
		"traces": "ad quas eius non ducimus",
		"serving_size": "200g",
		"serving_quantity": "2.64",
		"nutriscore_score": 48,
		"nutriscore_grade": "E",
		"main_category": "category2",
		"image_url": "https:\/\/via.placeholder.com\/640x480.png\/001122?text=et",
		"created_at": "2023-06-15T03:59:05.000000Z",
		"updated_at": "2023-06-15T03:59:05.000000Z"
	}
]
```

### Detalhes da API

Retorna informações sobre a API, como status da conexão com o banco de dados, uso de memória e tempo de atividade.

**Endpoint**: `GET /api/`

**Resposta de exemplo**:

```json
{
  "database_connection": "Connection OK; waiting to send",
  "memory_usage": "128MB",
  "uptime": "2 days, 4 hours, 32 minutes"
}
```

### Mostrar produto

Retorna os detalhes de um produto específico.

**Endpoint**: `GET /api/products/{code}`

**Parâmetros de URL**:

- `code`: O código único do produto

**Resposta de exemplo**:

```json
[
	{
		"id": 31,
		"code": "277895149",
		"status": "published",
		"imported_t": "2023-06-30 03:59:03",
		"url": "http:\/\/www.abreu.com\/in-vel-fugiat-iure-quisquam-voluptas-voluptate-blanditiis",
		"creator": "Simone Matias",
		"created_t": 630874432,
		"last_modified_t": 412420350,
		"product_name": "Delectus id consequatur possimus velit error.",
		"quantity": "17582",
		"brands": "Perez e Abreu",
		"categories": "dolore sed est beatae nostrum",
		"labels": "illum officiis et",
		"cities": "Quintana d'Oeste",
		"purchase_places": "Porto Kauan, Andorra",
		"stores": "Toledo Ltda.",
		"ingredients_text": "Sit quod blanditiis necessitatibus. Ipsa laborum eum magni. Nesciunt voluptas facilis doloremque labore qui sunt ab amet.",
		"traces": "magnam omnis deleniti libero ex",
		"serving_size": "250g",
		"serving_quantity": "7.59",
		"nutriscore_score": 41,
		"nutriscore_grade": "E",
		"main_category": "category2",
		"image_url": "https:\/\/via.placeholder.com\/640x480.png\/005599?text=et",
		"created_at": "2023-06-15T03:59:05.000000Z",
		"updated_at": "2023-06-15T03:59:05.000000Z"
	},
	{
		"id": 32,
		"code": "778628884",
		"status": "draft",
		"imported_t": "2023-06-30 03:59:03",
		"url": "https:\/\/ortega.com\/itaque-dolorum-facere-sed-possimus-quae.html",
		"creator": "Sr. George Assunção Montenegro",
		"created_t": 1329032902,
		"last_modified_t": 817617532,
		"product_name": "Molestiae quod aperiam officia debitis sed.",
		"quantity": "3646",
		"brands": "Ávila-da Silva",
		"categories": "culpa maiores ullam est eum",
		"labels": "tenetur ipsa quam",
		"cities": "São Reinaldo",
		"purchase_places": "Corona d'Oeste, Rússia",
		"stores": "Salazar Ltda.",
		"ingredients_text": "Non cupiditate voluptatibus natus dolores. Officiis deserunt consequatur explicabo rerum maiores quis. Qui repudiandae corporis id voluptas et accusamus.",
		"traces": "nesciunt quia esse pariatur odio",
		"serving_size": "200g",
		"serving_quantity": "8.78",
		"nutriscore_score": 95,
		"nutriscore_grade": "D",
		"main_category": "category2",
		"image_url": "https:\/\/via.placeholder.com\/640x480.png\/00aa77?text=ut",
		"created_at": "2023-06-15T03:59:05.000000Z",
		"updated_at": "2023-06-15T03:59:05.000000Z"
	}
]
```

**Códigos de status**:

200 OK: Produto atualizado com sucesso
404 Not Found: Produto não encontrado

### Atualizar produto

Atualiza os dados de um produto existente.

**Endpoint**: `PUT /api/products/{code}`

**Parâmetros de URL**:

- `code`: O código único do produto

**Parâmetros de solicitação**:

Os parâmetros a serem enviados no corpo da solicitação devem seguir o seguinte formato:

```json
{
  "code": "0001",
  "status": "published",
  "url": "url para o produto",
  "creator": "Criador do Produto",
  "product_name": "Nome do produto.",
  "quantity": "17582",
  "brands": "Perez e Abreu",
  "categories": "dolore sed est beatae nostrum",
  "labels": "illum officiis et",
  "cities": "Quintana d'Oeste",
  "purchase_places": "Porto Kauan, Andorra",
  "stores": "Toledo Ltda.",
  "ingredients_text": "Sit quod blanditiis necessitatibus. Ipsa laborum eum magni. Nesciunt voluptas facilis doloremque labore qui sunt ab amet.",
  "traces": "magnam omnis deleniti libero ex",
  "serving_size": "250g",
  "serving_quantity": "7.59",
  "nutriscore_score": 41,
  "nutriscore_grade": "E",
  "main_category": "category2",
  "image_url": "https://via.placeholder.com/640x480.png/005599?text=et"
}

```

**Resposta de exemplo**:

```json
{
	"id": 31,
	"code": "277895149",
	"status": "draft",
	"imported_t": "2023-06-15 04:19:52",
	"url": "http:\/\/www.abreu.com\/in-vel-fugiat-iure-quisquam-voluptas-voluptate-banda",
	"creator": "joao",
	"created_t": 630874432,
	"last_modified_t": 412420350,
	"product_name": "Delectus id consequatur possimus velit error.",
	"quantity": "17582",
	"brands": "Perez e Abreu",
	"categories": "dolore sed est beatae nostrum",
	"labels": "illum officiis et",
	"cities": "Quintana d'Oeste",
	"purchase_places": "Porto Kauan, Andorra",
	"stores": "Toledo Ltda.",
	"ingredients_text": "Sit quod blanditiis necessitatibus. Ipsa laborum eum magni. Nesciunt voluptas facilis doloremque labore qui sunt ab amet.",
	"traces": "magnam omnis deleniti libero ex",
	"serving_size": "250g",
	"serving_quantity": "7.59",
	"nutriscore_score": 41,
	"nutriscore_grade": "E",
	"main_category": "category2",
	"image_url": "https:\/\/via.placeholder.com\/640x480.png\/005599?text=et",
	"created_at": "2023-06-15T03:59:05.000000Z",
	"updated_at": "2023-06-15T04:19:52.000000Z"
}
```

### Excluir produto

Remove um produto existente.

**Endpoint**: `DELETE /api/products/{code}`

**Parâmetros de URL**:

- `code`: O código único do produto

**Resposta de exemplo**:

Status de resposta: 204 No Content

## Notas

- Todas as rotas da API exigem autenticação. Certifique-se de incluir um token de autenticação válido no cabeçalho da solicitação.
- Para as rotas que exigem um objeto JSON no corpo da solicitação, certifique-se de definir o cabeçalho `Content-Type: application/json` na solicitação.

>  This is a challenge by [Coodesh](https://coodesh.com/)