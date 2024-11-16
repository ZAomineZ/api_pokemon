# Pokémon API

## 🌟 Description

**Pokémon API** is a web application designed to provide detailed information about Pokémon. It allows easy access to data such as types, abilities, stats, evolutions, generations, and much more. This API is ideal for developers who want to integrate Pokémon features into their projects.

---

# 🚀 Project Installation Guide

## 📋 Prerequisites

Before getting started, ensure your system has the following tools installed:

- **PHP 8.0 or higher**
- **Composer** (PHP dependency manager)
- **MySQL** or **PostgreSQL** (database)
- **Node.js** and **npm** (optional, if the project includes front-end components)
- **Git** (to clone the project)

---

## 📥 Installation Steps

### 1️⃣ **Clone the repository**

Start by cloning the GitHub repository:

```bash
git clone https://github.com/ZAomineZ/api_pokemon.git

cd api_pokemon
```

### 2️⃣ **Install dependencies**

Install PHP dependencies with Composer:

```bash
composer install
npm install
```

### 3️⃣ **Configure the environment**

Copy the .env.example file to create your .env file:

```bash
cp .env.example .env

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pokemon_api
DB_USERNAME=root
DB_PASSWORD=your_password
```

###  4️⃣ **Migrate and seed the database**

Create the necessary tables and populate the database with initial data:
```bash
php artisan migrate
```

### 5️⃣ Start the local server

Start the Laravel development server:

```bash
php artisan serve
```

```bash
http://localhost:8000
```
---

# 📦 Scraping Pokémon Data

To scrape and import Pokémon data into your database, you need to use a specific Artisan command.

---

## 📋 Command to execute

Run the following command in your terminal:
```bash
php artisan scrapp:pokemon
```

### 🛠️ How it works

#### What does this command do?

- This command retrieves Pokémon data from an external source (e.g., an API or a file).
- The scraped data is then transformed and saved into the database.

#### Prerequisites before executing the command:

1. Ensure your database is configured and migrated.
2. The .env file must contain the correct database connection details.
3. Verify that the data source (API or file) is accessible.
---

## 📚 API Features

### 🔍 Pokémon Search:
- Search for a Pokémon by its name (English or French) or unique number.
- Filter Pokémon by various criteria: weight, height, generation, types, abilities, or specific moves.

### 📊 Complete Stats:
- Access detailed stats such as attack, defense, speed, special attack, and more.
- View abilities associated with each Pokémon, with detailed descriptions.

### 🌐 Generations and Types:
- Explore Pokémon by generation or type for easy classification.
- Search for generations by name (English or French) and discover associated Pokémon.
- Access type compatibility information (e.g., strengths and weaknesses of Fire, Water, etc.).

### 🌀 Moves:
- List available moves for each Pokémon with details such as power, accuracy, and PP.
- Search for moves by name and discover the Pokémon that can learn them.

### 💡 Abilities:
- Explore unique abilities for each Pokémon, with descriptions in English and French.
- Search for abilities by name to identify Pokémon that possess them.

### 📋 Pagination and Search:
- Easily paginate results to navigate large lists of Pokémon, types, abilities, or generations.
- Use advanced filters to quickly find relevant information.
---

These features enable a complete and precise exploration of the Pokémon universe, tailored to both developers and end-users.

# API Pokémon - Documentation des Query Parameters

## 🌟 Endpoints principaux

### **`/api/pokemons`**
This endpoint lets you search for and filter Pokémon according to various criteria.

---

## 📚 Available Query Parameters

### **Keyword Search**
- **Parameter:** `q`
- **Description:** Filter Pokémon whose name (in English) contains the given keyword.
- **Type:** `string`
- **Example:**
  ```http
  GET /api/pokemons?q=bulb
  ```

### **List of Parameters**

| **Parameter**         | **Description**                                   | **Type**      | **Example**                   |
|------------------------|---------------------------------------------------|---------------|-------------------------------|
| `q`                   | Search by keyword in the name                     | `string`      | `?q=bulb`                    |
| `num`                 | Search by number                                  | `integer`     | `?num=1`                     |
| `base_experience`     | Filter by base experience                         | `integer`     | `?base_experience=50`        |
| `type`                | Filter by type                                    | `string`      | `?type=grass`                |
| `ability`             | Filter by ability                                 | `string`      | `?ability=overgrow`          |
| `move`                | Filter by move                                    | `string`      | `?move=tackle`               |
| `generation`          | Filter by generation                              | `string`      | `?generation=Generation I`   |
| `weight`              | Weight greater than the given value               | `integer`     | `?weight=50`                 |
| `height`              | Height greater than the given value               | `integer`     | `?height=10`                 |
| `hp`                  | Hit points                                        | `integer`     | `?hp=45`                     |
| `attack`              | Attack value                                      | `integer`     | `?attack=49`                 |
| `defense`             | Defense value                                     | `integer`     | `?defense=49`                |
| `special_attack`      | Special attack value                              | `integer`     | `?special_attack=65`         |
| `special_defense`     | Special defense value                             | `integer`     | `?special_defense=65`        |
| `speed`               | Speed                                             | `integer`     | `?speed=45`                  |
| `legendary`           | Find legendary Pokémon                            | `boolean`     | `?legendary=true`            |
| `mega_evolution`      | Find Pokémon with mega evolution                  | `boolean`     | `?mega_evolution=true`       |


# API Pokémon - Endpoint: `/api/pokemons/{name}`

## 🌟 Description

This endpoint retrieves complete information about a specific Pokémon using its name (in English or French). The returned data includes the Pokémon's details, generations, abilities, types, moves, and stats.

---

## 📥 Request

### **HTTP Method:** `GET`

### **URL:** `/api/pokemons/{name}`

### **Parameters**

| **Parameter** | **Type**   | **Required** | **Description**                      |
|---------------|------------|--------------|---------------------------------------|
| `name`        | `string`   | Yes          | The name of the Pokémon (in English or French). |

---

## 📤 Response

### **Format:** `application/json`

### **Structure of the returned data:**

```json
{
    "id": 1,
    "number": 1,
    "name_fr": "Bulbizarre",
    "name_en": "Bulbasaur",
    "name_jap_kanji": "フシギダネ",
    "name_jap": "Fushigidane",
    "weight": 69,
    "height": 7,
    "base_experience": 64,
    "image": "https://example.com/images/bulbasaur.png",
    "mega_evolution": false,
    "legendary": false,
    "generations": [
        {
            "name_fr": "1er génération",
            "name_en": "Generation I"
        }
    ],
    "abilities": [
        {
            "id": 1,
            "name_en": "overgrow",
            "slug_fr": "engrais",
            "slug_en": "overgrow",
            "content_en": "Boosts grass moves at low HP.",
            "content_short_en": "Boosts grass moves at low HP."
        }
    ],
    "stat": {
        "hp": 45,
        "attack": 49,
        "defense": 49,
        "special_attack": 65,
        "special_defense": 65,
        "speed": 45
    },
    "types": [
        {
            "id": 1,
            "name_en": "grass",
            "name_fr": "Plante"
        }
    ],
    "moves_pokemon": [
        "http://127.0.0.1:8000/api/moves/razor-wind"
    ]
}
```

# API Pokémon - Endpoint : `/api/moves`

## 🌟 Description

Cet endpoint permet de récupérer une liste paginée des mouvements (moves) Pokémon. Il offre également la possibilité de filtrer les résultats en fonction de plusieurs critères comme le nom, la précision (accuracy), la puissance (power) ou le nombre d'utilisations (PP).

# API Pokémon - Endpoint: `/api/moves`

## 🌟 Description

This endpoint retrieves a paginated list of Pokémon moves. It also allows filtering results based on several criteria such as name, accuracy, power, or PP (Power Points).

---

## 📥 Request

### **HTTP Method:** `GET`

### **URL:** `/api/moves`

### **Available Query Parameters**

| **Parameter** | **Type**   | **Required** | **Description**                                                    |
|---------------|------------|--------------|--------------------------------------------------------------------|
| `per_page`    | `integer`  | No           | Number of results per page. Default value: `25`.                   |
| `q`           | `string`   | No           | Search by keyword in the move's name (English only).               |
| `accuracy`    | `integer`  | No           | Filter moves by exact accuracy.                                    |
| `power`       | `integer`  | No           | Filter moves by exact power.                                       |
| `pp`          | `integer`  | No           | Filter moves by number of Power Points (PP).                       |

---

n/json`

### **Structure of the returned data:**

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "name_en": "tackle",
            "name_fr": "Charge",
            "slug_en": "tackle",
            "slug_fr": "charge",
            "accuracy": 100,
            "power": 40,
            "pp": 35,
            "content_en": "Inflicts regular damage.",
            "short_content_en": "Inflicts regular damage with no additional effect."
        },
        {
            "id": 2,
            "name_en": "Thunderbolt",
            "name_fr": "Tonnerre",
            "slug_en": "thunderbolt",
            "slug_fr": "tonnerre",
            "accuracy": 100,
            "power": 90,
            "pp": 15,
            "content_en": "Inflicts regular damage.  Has a 10% chance to paralyze the target.",
            "short_content_end": "Has a 10% chance to paralyze the target."
        }
    ],
    "first_page_url": "http://example.com/api/moves?page=1",
    "from": 1,
    "last_page": 10,
    "last_page_url": "http://example.com/api/moves?page=10",
    "next_page_url": "http://example.com/api/moves?page=2",
    "path": "http://example.com/api/moves",
    "per_page": 25,
    "prev_page_url": null,
    "to": 25,
    "total": 250
}
```
# API Pokémon - Endpoint: `/api/moves/{name}`

## 🌟 Description

This endpoint retrieves the details of a specific Pokémon move using its English name. The returned data includes information about the move and associated Pokémon, with dynamically hidden relationships to simplify the response.

---

## 📥 Request

### **HTTP Method:** `GET`

### **URL:** `/api/moves/{name}`

### **Parameters**

| **Parameter** | **Type**   | **Required** | **Description**                             |
|---------------|------------|--------------|---------------------------------------------|
| `name`        | `string`   | Yes          | The English name of the Pokémon move.       |

---

## 📤 Response

### **Format:** `application/json`

### **Structure of the returned data:**

```json
{
    "id": 7,
    "name_fr": "Charge",
    "name_en": "tackle",
    "slug_en": "tackle",
    "slug_fr": "charge",
    "accuracy": 100,
    "power": 40,
    "pp": 35,
    "content_en": "Inflicts regular damage.",
    "short_content_en": "Inflicts regular damage with no additional effect.",
    "pokemons": [
        "http://127.0.0.1:8000/api/pokemons/Bulbasaur",
        "http://127.0.0.1:8000/api/pokemons/Ivysaur"
    ]
}
```
---
# API Pokémon - Endpoint: `/api/types`

## 🌟 Description

This endpoint retrieves a paginated list of Pokémon types. It also allows searching by keyword in the English name of the types. Unnecessary relationships, such as associated Pokémon, are loaded for internal purposes but hidden in the response.

---

## 📥 Request

### **HTTP Method:** `GET`

### **URL:** `/api/types`

### **Available Query Parameters**

| **Parameter** | **Type**   | **Required** | **Description**                                                    |
|---------------|------------|--------------|--------------------------------------------------------------------|
| `per_page`    | `integer`  | No           | Number of results per page. Default value: `25`.                   |
| `q`           | `string`   | No           | Search by keyword in the type's name (English only).               |

---

## 📤 Response

### **Format:** `application/json`

### **Structure of the returned data:**

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "name_fr": "Plante",
            "name_en": "grass",
            "slug_fr": "plante",
            "slug_en": "grass",
            "type_pokemons": [
                "http://127.0.0.1:8000/api/pokemons/Bulbasaur"
            ]
        },
        {
            "id": 2,
            "name_fr": "Feu",
            "name_en": "fire",
            "slug_fr": "feu",
            "slug_en": "fire",
            "type_pokemons": [
                "http://127.0.0.1:8000/api/pokemons/Charmander"
            ]
        }
    ],
    "first_page_url": "http://example.com/api/types?page=1",
    "from": 1,
    "last_page": 5,
    "last_page_url": "http://example.com/api/types?page=5",
    "next_page_url": "http://example.com/api/types?page=2",
    "path": "http://example.com/api/types",
    "per_page": 25,
    "prev_page_url": null,
    "to": 25,
    "total": 100
}
```

# API Pokémon - Endpoint: `/api/types/{name}`

## 🌟 Description

This endpoint retrieves the details of a specific Pokémon type using its name (in English or French). The returned data includes information about the type as well as the Pokémon associated with it. Certain unnecessary relationships, such as `type_pokemons`, are dynamically hidden to simplify the response.

---

## 📥 Request

### **HTTP Method:** `GET`

### **URL:** `/api/types/{name}`

### **Parameters**

| **Parameter** | **Type**   | **Required** | **Description**                             |
|---------------|------------|--------------|---------------------------------------------|
| `name`        | `string`   | Yes          | The name of the Pokémon type (in English or French). |


markdown
Copier le code
---

## 📤 Response

### **Format:** `application/json`

### **Structure of the returned data:**

```json
{
    "id": 1,
    "name_fr": "Feu",
    "name_en": "fire",
    "slug_fr": "feu",
    "slug_en": "fire",
    "type_pokemons": [
        "http://127.0.0.1:8000/api/pokemons/Charmander",
        "http://127.0.0.1:8000/api/pokemons/Charmeleon",
        "http://127.0.0.1:8000/api/pokemons/Charizard",
        "http://127.0.0.1:8000/api/pokemons/Vulpix"
    ]
}
```

# API Pokémon - Endpoint: `/api/abilities`

## 🌟 Description

This endpoint retrieves a paginated list of Pokémon abilities. It supports keyword search for ability names in English. Unnecessary relationships, such as associated Pokémon, are loaded for internal purposes but hidden in the response.

---

## 📥 Request

### **HTTP Method:** `GET`

### **URL:** `/api/abilities`

### **Available Query Parameters**

| **Parameter** | **Type**   | **Required** | **Description**                                                    |
|---------------|------------|--------------|--------------------------------------------------------------------|
| `per_page`    | `integer`  | No           | Number of results per page. Default value: `25`.                   |
| `q`           | `string`   | No           | Search by keyword in the ability name (English only).              |

---

## 📤 Response

### **Format:** `application/json`

### **Structure of the returned data:**

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "name_en": "overgrow",
            "name_fr": "Engrais",
            "slug_en": "overgrow",
            "slug_fr": "engrais",
            "content_en": "When this Pokémon has 1/3 or less of its HP remaining, its grass-type moves inflict 1.5× as much regular damage.",
            "content_short_en": "Strengthens grass moves to inflict 1.5× damage at 1/3 max HP or less.",
            "ability_pokemons": [
                "http://127.0.0.1:8000/api/pokemons/Bulbasaur",
                "http://127.0.0.1:8000/api/pokemons/Ivysaur",
                "http://127.0.0.1:8000/api/pokemons/Venusaur"
            ]
        },
        {
            "id": 3,
            "name_en": "blaze",
            "name_fr": "Brasier",
            "slug_en": "blaze",
            "slug_fr": "brasier",
            "content_en": "When this Pokémon has 1/3 or less of its HP remaining, its fire-type moves inflict 1.5× as much regular damage.",
            "content_short_en": "Strengthens fire moves to inflict 1.5× damage at 1/3 max HP or less.",
            "ability_pokemons": [
                "http://127.0.0.1:8000/api/pokemons/Charmander",
                "http://127.0.0.1:8000/api/pokemons/Charmeleon",
                "http://127.0.0.1:8000/api/pokemons/Charizard"
            ]
        }
    ],
    "first_page_url": "http://example.com/api/abilities?page=1",
    "from": 1,
    "last_page": 5,
    "last_page_url": "http://example.com/api/abilities?page=5",
    "next_page_url": "http://example.com/api/abilities?page=2",
    "path": "http://example.com/api/abilities",
    "per_page": 25,
    "prev_page_url": null,
    "to": 25,
    "total": 100
}
```

# API Pokémon - Endpoint: `/api/abilities/{name}`

## 🌟 Description

This endpoint retrieves the details of a specific Pokémon ability using its English name. The returned data includes information about the ability as well as the associated Pokémon. Certain unnecessary relationships, such as `moves_pokemon`, are dynamically hidden to simplify the response.

---

## 📥 Request

### **HTTP Method:** `GET`

### **URL:** `/api/abilities/{name}`

### **Parameters**

| **Parameter** | **Type**   | **Required** | **Description**                             |
|---------------|------------|--------------|---------------------------------------------|
| `name`        | `string`   | Yes          | The name of the Pokémon ability in English. |

---

## 📤 Response

### **Format:** `application/json`

### **Structure of the returned data:**

```json
{
    "id": 1,
    "name_en": "overgrow",
    "name_fr": "Engrais",
    "slug_en": "overgrow",
    "slug_fr": "engrais",
    "content_en": "When this Pokémon has 1/3 or less of its HP remaining, its grass-type moves inflict 1.5× as much regular damage.",
    "content_short_en": "Strengthens grass moves to inflict 1.5× damage at 1/3 max HP or less.",
    "ability_pokemons": [
        "http://127.0.0.1:8000/api/pokemons/Bulbasaur",
        "http://127.0.0.1:8000/api/pokemons/Ivysaur",
        "http://127.0.0.1:8000/api/pokemons/Venusaur"
    ]
}
```

# API Pokémon - Endpoint: `/api/generations`

## 🌟 Description

This endpoint retrieves a paginated list of Pokémon generations. It supports keyword search for generation names in English. Unnecessary relationships, such as associated Pokémon, are loaded for internal purposes but hidden in the response.

---

## 📥 Request

### **HTTP Method:** `GET`

### **URL:** `/api/generations`

### **Available Query Parameters**

| **Parameter** | **Type**   | **Required** | **Description**                                                    |
|---------------|------------|--------------|--------------------------------------------------------------------|
| `per_page`    | `integer`  | No           | Number of results per page. Default value: `25`.                   |
| `q`           | `string`   | No           | Search by keyword in the generation name (English only).           |

---

## 📤 Response

### **Format:** `application/json`

### **Structure of the returned data:**

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "name_en": "Generation I",
            "name_fr": "1er génération",
            "slug_en": "generation-i",
            "slug_fr": "1er-generation"
        },
        {
            "id": 3,
            "name_en": "Generation II",
            "name_fr": "2e génération",
            "slug_en": "generation-ii",
            "slug_fr": "2e-generation"
        }
    ],
    "first_page_url": "http://example.com/api/generations?page=1",
    "from": 1,
    "last_page": 5,
    "last_page_url": "http://example.com/api/generations?page=5",
    "next_page_url": "http://example.com/api/generations?page=2",
    "path": "http://example.com/api/generations",
    "per_page": 25,
    "prev_page_url": null,
    "to": 25,
    "total": 100
}
```

# API Pokémon - Endpoint: `/api/generations/{name}`

## 🌟 Description

This endpoint retrieves the details of a specific Pokémon generation using its name (in English or French).

---

## 📥 Request

### **HTTP Method:** `GET`

### **URL:** `/api/generations/{name}`

### **Parameters**

| **Parameter** | **Type**   | **Required** | **Description**                             |
|---------------|------------|--------------|---------------------------------------------|
| `name`        | `string`   | Yes          | The name of the Pokémon generation (in English or French). |

---

## 📤 Response

### **Format:** `application/json`

### **Structure of the returned data:**

```json
{
    "id": 1,
    "name_en": "Generation I",
    "name_fr": "1ère Génération",
    "created_at": "2024-01-01T12:00:00Z",
    "updated_at": "2024-01-01T12:00:00Z",
    "generation_pokemons": [
        "http://127.0.0.1:8000/api/pokemons/Bulbasaur",
        "http://127.0.0.1:8000/api/pokemons/Ivysaur",
        "http://127.0.0.1:8000/api/pokemons/Venusaur",
        "http://127.0.0.1:8000/api/pokemons/Charmander"
    ]
}
```
---

### 🧩 Technologies Used

- **Backend:** Laravel
- **Database:** PostgreSQL

---

### 📝 Contribution

Contributions are welcome! If you want to add features, fix bugs, or improve the project, follow these steps:

1. Fork the project.
2. Create a branch for your feature:
   ```bash
   git checkout -b feature/your-feature-name
   ```
3. Make your changes and commit them:
    ```bash
    git commit -m "Ajout de la fonctionnalité X"
    ```
4. Push your changes:
    ```bash
    git push origin feature/nom-de-la-fonctionnalite
    ```
5. Create a Pull Request.
