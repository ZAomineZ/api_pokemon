# Pokémon API

## 🌟 Description

**Pokémon API** est une application web conçue pour fournir des informations détaillées sur les Pokémon. Elle permet d’accéder facilement à des données telles que les types, les capacités, les statistiques, les évolutions, les générations, et bien plus encore. Cette API est idéale pour les développeurs souhaitant intégrer des fonctionnalités Pokémon dans leurs projets.

---
# 🚀 Guide d'installation du projet Pokémon API

## 📋 Prérequis

Avant de commencer, assurez-vous que votre système dispose des outils suivants installés :

- **PHP 8.0 ou supérieur**
- **Composer** (gestionnaire de dépendances PHP)
- **MySQL** ou **PostgreSQL** (base de données)
- **Node.js** et **npm** (optionnel si le projet inclut des éléments front-end)
- **Git** (pour cloner le projet)

---

## 📥 Étapes d'installation

### 1️⃣ **Cloner le dépôt**

Commencez par cloner le dépôt GitHub :

```bash
git clone https://github.com/votre-utilisateur/pokemon-api.git

cd pokemon-api
```

### 2️⃣ **Installer les dépendances**

Installez les dépendances PHP avec Composer:

```bash
composer install
npm install
```

### 3️⃣ **Installer les dépendances**

Copiez le fichier d'exemple .env.example pour créer votre fichier .env:

```bash
cp .env.example .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pokemon_api
DB_USERNAME=root
DB_PASSWORD=your_password
```

###  4️⃣ **Migrer et peupler la base de données**

Créez les tables nécessaires et ajoutez les données initiales en exécutant:
```bash
php artisan migrate
```

### 5️⃣ Lancer le serveur local

Démarrez le serveur de développement Laravel:

```bash
php artisan serve
```

```bash
http://localhost:8000
```
---

# 📦 Scrapper les données des Pokémon

Pour scrapper et importer les données des Pokémon dans votre base de données, vous devez utiliser une commande Artisan prévue à cet effet.

---

## 📋 Commande à exécuter

Exécutez la commande suivante dans votre terminal :

```bash
php artisan scrapp:pokemon
```

### 🛠️ Fonctionnement

#### Que fait cette commande ?

- Cette commande récupère des données des Pokémon à partir d'une source externe (par exemple, une API ou un fichier).
- Les données scrappées sont ensuite transformées et sauvegardées dans la base de données.

#### Prérequis avant d'exécuter la commande :

1. Assurez-vous que votre base de données est configurée et migrée.
2. Le fichier `.env` doit contenir les informations correctes de connexion à la base de données.
3. Vérifiez que la source des données (API ou fichier) est accessible.
---

## 📚 Fonctionnalités de l'api

- **🔍 Recherche de Pokémon :**
    - Recherchez un Pokémon par son nom (anglais ou français) ou son numéro unique.
    - Filtrez les Pokémon selon plusieurs critères : poids, taille, génération, types, capacités ou mouvements spécifiques.

- **📊 Statistiques complètes :**
    - Obtenez des statistiques détaillées comme l'attaque, la défense, la vitesse, l'attaque spéciale, et plus encore.
    - Consultez les capacités associées à chaque Pokémon avec des descriptions précises.

- **🌐 Générations et types :**
    - Explorez les Pokémon par génération ou type pour une classification facile.
    - Recherchez des générations par leur nom (anglais ou français) et découvrez les Pokémon associés.
    - Accédez aux compatibilités des types (par exemple, les forces et faiblesses des types Feu, Eau, etc.).

- **🌀 Mouvements (Moves) :**
    - Listez les mouvements disponibles pour chaque Pokémon, avec des détails tels que la puissance, la précision et le nombre de PP.
    - Recherchez des mouvements par leur nom et découvrez les Pokémon qui peuvent les apprendre.

- **💡 Capacités (Abilities) :**
    - Explorez les capacités uniques de chaque Pokémon, avec des descriptions en anglais et en français.
    - Recherchez des capacités par leur nom pour identifier les Pokémon qui les possèdent.

- **📋 Pagination et recherche :**
    - Paginez facilement les résultats pour naviguer dans de grandes listes de Pokémon, types, capacités ou générations.
    - Utilisez des filtres avancés pour trouver rapidement les informations pertinentes.

---

Ces fonctionnalités permettent une exploration complète et précise de l'univers Pokémon, adaptée à la fois aux développeurs et aux utilisateurs finaux.

# API Pokémon - Documentation des Query Parameters

## 🌟 Endpoints principaux

### **`/api/pokemons`**
Cet endpoint permet de rechercher et de filtrer les Pokémon en fonction de différents critères.

---

## 📚 Query Parameters disponibles

### **Recherche par mot-clé**
- **Paramètre :** `q`
- **Description :** Filtrer les Pokémon dont le nom (anglais) contient le mot-clé donné.
- **Type :** `string`
- **Exemple :**
  ```http
  GET /api/pokemons?q=bulb
  ```

### **Liste des paramètres**

| **Paramètre**         | **Description**                                   | **Type**      | **Exemple**                   |
|------------------------|---------------------------------------------------|---------------|-------------------------------|
| `q`                   | Recherche par mot-clé dans le nom                 | `string`      | `?q=bulb`                    |
| `num`                 | Recherche par numéro                              | `integer`     | `?num=1`                     |
| `base_experience`     | Filtrer par expérience de base                    | `integer`     | `?base_experience=50`        |
| `type`                | Filtrer par type                                  | `string`      | `?type=grass`                |
| `ability`             | Filtrer par capacité                              | `string`      | `?ability=overgrow`          |
| `move`                | Filtrer par mouvement                             | `string`      | `?move=tackle`               |
| `generation`          | Filtrer par génération                            | `string`      | `?generation=Generation I`   |
| `weight`              | Poids supérieur à la valeur donnée                | `integer`     | `?weight=50`                 |
| `height`              | Taille supérieure à la valeur donnée              | `integer`     | `?height=10`                 |
| `hp`                  | Points de vie                                     | `integer`     | `?hp=45`                     |
| `attack`              | Valeur d'attaque                                  | `integer`     | `?attack=49`                 |
| `defense`             | Valeur de défense                                 | `integer`     | `?defense=49`                |
| `special_attack`      | Attaque spéciale                                  | `integer`     | `?special_attack=65`         |
| `special_defense`     | Défense spéciale                                  | `integer`     | `?special_defense=65`        |
| `speed`               | Vitesse                                           | `integer`     | `?speed=45`                  |
| `legendary`           | Trouver les Pokémon légendaires                   | `boolean`     | `?legendary=true`            |
| `mega_evolution`      | Trouver les Pokémon avec une méga-évolution       | `boolean`     | `?mega_evolution=true`       |

# API Pokémon - Endpoint : `/api/pokemons/{name}`

## 🌟 Description

Cet endpoint permet de récupérer les informations complètes sur un Pokémon spécifique en utilisant son nom (en anglais ou en français). Les données retournées incluent les détails du Pokémon, ses générations, ses capacités, ses types, ses mouvements, et ses statistiques.

---

## 📥 Requête

### **Méthode HTTP :** `GET`

### **URL :** `/api/pokemons/{name}`

### **Paramètres**

| **Paramètre** | **Type**   | **Requis** | **Description**                       |
|---------------|------------|------------|---------------------------------------|
| `name`        | `string`   | Oui        | Le nom du Pokémon (en anglais ou français). |

---

## 📤 Réponse

### **Format :** `application/json`

### **Structure des données retournées :**

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

---

## 📥 Requête

### **Méthode HTTP :** `GET`

### **URL :** `/api/moves`

### **Query Parameters disponibles**

| **Paramètre** | **Type**   | **Requis** | **Description**                                                    |
|---------------|------------|------------|--------------------------------------------------------------------|
| `per_page`    | `integer`  | Non        | Nombre de résultats par page. Valeur par défaut : `25`.            |
| `q`           | `string`   | Non        | Recherche par mot-clé dans le nom du mouvement (anglais uniquement).|
| `accuracy`    | `integer`  | Non        | Filtrer les mouvements par précision exacte.                       |
| `power`       | `integer`  | Non        | Filtrer les mouvements par puissance exacte.                       |
| `pp`          | `integer`  | Non        | Filtrer les mouvements par nombre d'utilisations (PP).             |

---

## 📤 Réponse

### **Format :** `application/json`

### **Structure des données retournées :**

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

# API Pokémon - Endpoint : `/api/moves/{name}`

## 🌟 Description

Cet endpoint permet de récupérer les détails d'un mouvement (move) Pokémon spécifique en utilisant son nom en anglais. Les données retournées incluent les informations sur le mouvement et les Pokémon associés, avec des relations masquées dynamiquement pour simplifier la réponse.

---

## 📥 Requête

### **Méthode HTTP :** `GET`

### **URL :** `/api/moves/{name}`

### **Paramètres**

| **Paramètre** | **Type**   | **Requis** | **Description**                             |
|---------------|------------|------------|---------------------------------------------|
| `name`        | `string`   | Oui        | Le nom en anglais du mouvement Pokémon.     |

---

## 📤 Réponse

### **Format :** `application/json`

### **Structure des données retournées :**

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

# API Pokémon - Endpoint : `/api/types`

## 🌟 Description

Cet endpoint permet de récupérer une liste paginée des types Pokémon. Il offre également la possibilité de rechercher par mot-clé sur le nom en anglais des types. Les relations inutiles, comme les Pokémon associés, sont chargées pour des besoins internes mais masquées dans la réponse.

---

## 📥 Requête

### **Méthode HTTP :** `GET`

### **URL :** `/api/types`

### **Query Parameters disponibles**

| **Paramètre** | **Type**   | **Requis** | **Description**                                                    |
|---------------|------------|------------|--------------------------------------------------------------------|
| `per_page`    | `integer`  | Non        | Nombre de résultats par page. Valeur par défaut : `25`.            |
| `q`           | `string`   | Non        | Recherche par mot-clé dans le nom du type (anglais uniquement).    |

---

## 📤 Réponse

### **Format :** `application/json`

### **Structure des données retournées :**

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

# API Pokémon - Endpoint : `/api/types/{name}`

## 🌟 Description

Cet endpoint permet de récupérer les détails d'un type Pokémon spécifique en utilisant son nom (en anglais ou en français). Les données retournées incluent des informations sur le type ainsi que les Pokémon associés à ce type. Certaines relations inutiles, comme `type_pokemons`, sont masquées dynamiquement pour simplifier la réponse.

---

## 📥 Requête

### **Méthode HTTP :** `GET`

### **URL :** `/api/types/{name}`

### **Paramètres**

| **Paramètre** | **Type**   | **Requis** | **Description**                             |
|---------------|------------|------------|---------------------------------------------|
| `name`        | `string`   | Oui        | Le nom du type Pokémon (en anglais ou français). |

---

## 📤 Réponse

### **Format :** `application/json`

### **Structure des données retournées :**

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

# API Pokémon - Endpoint : `/api/abilities`

## 🌟 Description

Cet endpoint permet de récupérer une liste paginée des capacités (abilities) Pokémon. Il prend en charge la recherche par mot-clé sur le nom en anglais des capacités. Les relations inutiles, comme les Pokémon associés, sont chargées pour des besoins internes mais masquées dans la réponse.

---

## 📥 Requête

### **Méthode HTTP :** `GET`

### **URL :** `/api/abilities`

### **Query Parameters disponibles**

| **Paramètre** | **Type**   | **Requis** | **Description**                                                    |
|---------------|------------|------------|--------------------------------------------------------------------|
| `per_page`    | `integer`  | Non        | Nombre de résultats par page. Valeur par défaut : `25`.            |
| `q`           | `string`   | Non        | Recherche par mot-clé dans le nom de la capacité (anglais uniquement). |

---

## 📤 Réponse

### **Format :** `application/json`

### **Structure des données retournées :**

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

# API Pokémon - Endpoint : `/api/abilities/{name}`

## 🌟 Description

Cet endpoint permet de récupérer les détails d'une capacité (ability) Pokémon spécifique en utilisant son nom en anglais. Les données retournées incluent des informations sur la capacité ainsi que les Pokémon associés. Certaines relations inutiles, comme `moves_pokemon`, sont masquées dynamiquement pour simplifier la réponse.

---

## 📥 Requête

### **Méthode HTTP :** `GET`

### **URL :** `/api/abilities/{name}`

### **Paramètres**

| **Paramètre** | **Type**   | **Requis** | **Description**                             |
|---------------|------------|------------|---------------------------------------------|
| `name`        | `string`   | Oui        | Le nom de la capacité Pokémon en anglais.   |

---

## 📤 Réponse

### **Format :** `application/json`

### **Structure des données retournées :**

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

# API Pokémon - Endpoint : `/api/generations`

## 🌟 Description

Cet endpoint permet de récupérer une liste paginée des générations Pokémon. Il prend en charge la recherche par mot-clé sur le nom en anglais des générations. Les relations inutiles, comme les Pokémon associés, sont chargées pour des besoins internes mais masquées dans la réponse.

---

## 📥 Requête

### **Méthode HTTP :** `GET`

### **URL :** `/api/generations`

### **Query Parameters disponibles**

| **Paramètre** | **Type**   | **Requis** | **Description**                                                    |
|---------------|------------|------------|--------------------------------------------------------------------|
| `per_page`    | `integer`  | Non        | Nombre de résultats par page. Valeur par défaut : `25`.            |
| `q`           | `string`   | Non        | Recherche par mot-clé dans le nom de la génération (anglais uniquement). |

---

## 📤 Réponse

### **Format :** `application/json`

### **Structure des données retournées :**

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

# API Pokémon - Endpoint : `/api/generations/{name}`

## 🌟 Description

Cet endpoint permet de récupérer les détails d'une génération Pokémon spécifique en utilisant son nom (en anglais ou en français).

---

## 📥 Requête

### **Méthode HTTP :** `GET`

### **URL :** `/api/generations/{name}`

### **Paramètres**

| **Paramètre** | **Type**   | **Requis** | **Description**                             |
|---------------|------------|------------|---------------------------------------------|
| `name`        | `string`   | Oui        | Le nom de la génération Pokémon (en anglais ou en français). |

---

## 📤 Réponse

### **Format :** `application/json`

### **Structure des données retournées :**

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

### 🧩 Technologies utilisées

- **Backend :** Laravel
- **Base de données :** PostgreSQL

---

### 📝 Contribution

Les contributions sont les bienvenues ! Si vous souhaitez ajouter des fonctionnalités, corriger des bugs, ou améliorer le projet, suivez ces étapes :

1. Forkez le projet.
2. Créez une branche pour votre fonctionnalité :
   ```bash
   git checkout -b feature/nom-de-la-fonctionnalité
   ```
3. Effectuez vos modifications et validez-les :
    ```bash
       git commit -m "Ajout de la fonctionnalité X"
    ```
4. Push les modifications :
    ```bash
       git push origin feature/nom-de-la-fonctionnalite
    ```
5. Créez une Pull Request.
