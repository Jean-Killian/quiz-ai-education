# 👾 BugHunter AI - Dev Training Simulator

**BugHunter AI** est une plateforme gamifiée de *Code Review* destinée aux développeurs. Apprenez à traquer les bugs, les failles de sécurité et les mauvaises pratiques dans des snippets de code générés dynamiquement par l'IA.

## 🚀 Démarrage Rapide

1. **Pré-requis** : PHP 8.2+, Composer.
2. **Installation** :
   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   php artisan migrate --seed
   ```
3. **Configuration IA** : Obtenez une clé gratuite sur [console.groq.com](https://console.groq.com) et ajoutez-la dans votre `.env` :
   ```env
   GROQ_API_KEY=votre_cle_gsk
   ```
4. **Lancement** :
   ```bash
   php artisan serve
   ```

## 📖 Documentation
Pour plus de détails techniques, consultez le dossier `/docs` :
- [**Vue d'ensemble & Stack**](./docs/Project_Overview.md) : Problématique et choix techniques.
- [Journal des Décisions (ADR)](./docs/Decision_Log.md) : Historique des choix d'architecture.
- [Stratégie Git](./docs/Git_Strategy.md) : Conventions de commit et flow.
- [Guide UI/UX](./docs/UX_UI_Guidelines.md) : Charte graphique "Hacker Theme".

## 🛠️ Stack Technique
- **Backend** : Laravel 12 (PHP)
- **Database** : SQLite
- **Intelligence** : Groq (Llama 3.3)
- **Frontend** : Tailwind CSS, Highlight.js, Marked.js

---
*Projet réalisé dans le cadre de l'école de développement.*
