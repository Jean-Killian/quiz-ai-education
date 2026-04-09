# 🔌 Contrat d'API REST (MVP Quiz AI)

Ce document décrit formellement l'interface contractuelle (Routes HTTP, Entrées, Sorties JSON, Erreurs) entre le frontend (ou tout client tiers) et le backend du générateur de Quiz.

L'approche choisie se base sur les standards REST (Retour `application/json`) pour garantir l'interopérabilité (Application web Axios/AlpineJS, SPA future ou Mobile App).

*(Note concernant Laravel : pour préserver ce format, les routes devront de préférence être appelées avec le header `Accept: application/json` pour empêcher les redirections indésirables par défaut de Laravel).*

---

## 1. `POST /api/quizzes/generate` (Générateur IA)

Cet endpoint déclenche le traitement par le Modèle de Langage (LLM). Il est asynchrone (potentiellement lent) et requiert des données textuelles précises.

- **Méthode :** `POST`
- **Authentification :** Requise (Bearer Token ou Sanctum Cookie).
- **Body de Requête (JSON) :**
```json
{
  "subject": "PHP", // (Requis) string, in: WHITE_LIST
  "difficulty": "Junior", // (Requis) enum: Junior, Medior, Senior
  "count": 5, // (Optionnel) int, default: 3
  "answers": 3 // (Optionnel) int, num d'options par question
}
```

- **Réponse Succès (`201 Created`) :**
Le quiz créé est directement renvoyé avec son ID pour une redirection côté front.
```json
{
  "message": "Quiz généré avec succès.",
  "data": {
    "quiz_id": 42,
    "title": "Quiz - La révolution française"
  }
}
```

- **Cas d'Erreur :**
  - `422 Unprocessable Entity` : Si le texte est trop court (Validation échouée en entrée). L'ID de l'erreur est renvoyé.
  - `503 Service Unavailable` : Si l'API d'Intelligence Artificielle est injoignable ou prend trop de temps (Timeout).
  - `401 Unauthorized` : Étudiant non identifié.

---

## 2. `GET /api/quizzes` (Lister les Quiz)

Permet d'afficher au Dashboard la liste historique des quiz générés par l'utilisateur (ou disponibles globalement pour la plateforme étudiante).

- **Méthode :** `GET`
- **Authentification :** Requise.
- **Réponse Succès (`200 OK`) :**
```json
{
  "data": [
    {
      "id": 42,
      "title": "La révolution française",
      "created_at": "2026-04-09T08:00:00.000Z",
      "user_score": 8 // (Optionnel) Retourne le Pivot si l'étudiant a déjà joué.
    },
    ...
  ],
  "meta": { "total": 25, "page": 1 }
}
```

---

## 3. `GET /api/quizzes/{quiz_id}` (Lancer le Player)

Fournit l'ensemble des questions et réponses liées à un Quiz. 
> [!WARNING]  
> **Sécurité du Contrat :** L'attribut `is_correct` présent en base pour les objets Answer NE DOIT PAS être remonté dans ce JSON par le backend pour éviter qu'un étudiant rusé ne lise la solution dans le réseau du navigateur.

- **Méthode :** `GET`
- **Authentification :** Requise.
- **Réponse Succès (`200 OK`) :**
```json
{
  "data": {
    "id": 42,
    "title": "Mission_Alpha",
    "difficulty": "Junior",
    "questions": [
      {
        "id": 105,
        "question_text": "```php\n// snippet\n```",
        "explanation": "Pourquoi le code est buggé...", // Uniquement renvoyé après quiz ou via endpoint spécifique
        "answers": [
          { "id": 500, "answer_text": "Correct Patch" },
          ...
        ]
      }
    ]
  }
}
```
- **Cas d'Erreur :** `404 Not Found` (Le quiz demandé n'existe plus).

---

## 4. `POST /api/quizzes/{quiz_id}/submit` (Correction & Passage)

Endpoint critique du système de participation (`quiz_user`). Évalue dynamiquement le dictionnaire de réponses fournies par l'élève.

- **Méthode :** `POST`
- **Authentification :** Requise.
- **Body de Requête (JSON) :**
```json
{
  "answers": [
    { "question_id": 105, "answer_id": 500 },
    { "question_id": 106, "answer_id": 504 }
  ]
}
```
*(Chaque question doit avoir une identité validée. Une règle de validation s'assura qu'aucune question n'a été loupée : `required|array` et `exists:answers,id` pour vérifier que la donnée n'a pas été falsifiée).*

- **Réponse Succès (`200 OK`) :**
Si le score existe déjà pour l'étudiant, il est écrasé (Upsert) côté Base de Données.
```json
{
  "message": "Réponses enregistrées.",
  "results": {
    "quiz_id": 42,
    "total_score": 10,
    "user_score": 8,
    "corrections": [
      {
        "question_id": 105,
        "is_correct": true,
        "correct_answer_id": 500
      },
      ...
    ]
  }
}
```
*(Le backend retourne alors le corrigé officiel `correct_answer_id` pour permettre une vue détaillée post-examen au frontend).*

- **Cas d'Erreur :**
  - `422 Unprocessable Entity` : Si l'étudiant a laissé une question sans réponse et que l'interface impose 100% de complétion.

---

## 5. `GET /api/leaderboard` (Hall of Fame)

Retourne les meilleurs opérateurs du réseau.

- **Méthode :** `GET`
- **Authentification :** Requise.
- **Réponse Succès (`200 OK`) :**
```json
{
  "data": [
    { "rank": 1, "name": "Neo", "global_score": 3100 },
    { "rank": 2, "name": "Morpheus", "global_score": 2450 }
  ]
}
```
