# 🚀 BugHunter AI - Présentation du Projet

## 📌 1. Problématique
Le projet **BugHunter AI** répond à une difficulté majeure rencontrée par les étudiants en développement : le passage de la syntaxe théorique à la **lecture critique de code**. 

La plupart des plateformes d'apprentissage se concentrent sur l'écriture de code ("Code this..."), mais peu entraînent l'œil à détecter les failles, les erreurs de logique ou les défauts d'architecture dans du code existant. 

**Question centrale :** 
> *Comment automatiser la création de scénarios de débogage réalistes et ludiques pour transformer des étudiants en "Senior Code Reviewers" ?*

---

## 🛠️ 2. Stack Technique & Justifications

Le projet repose sur un socle technologique moderne choisi pour sa rapidité d'exécution et sa facilité de déploiement.

### **Core Backend**
- **Laravel 12 (PHP 8.2+)** : 
  - *Pourquoi ?* Pour sa gestion native des sessions, sa sécurité (CSRF, Injection SQL via Eloquent) et sa rapidité de prototypage via Laravel Breeze.
- **SQLite** :
  - *Pourquoi ?* Pour la portabilité totale. C'est une base de données fichier qui ne nécessite aucune installation de serveur tiers, idéale pour un projet école ou un MVP.

### **Moteur IA (Le Cœur du jeu)**
- **Groq Cloud (Llama 3.3 Versatile)** :
  - *Pourquoi ?* **La performance.** Groq utilise des LPU (Language Processing Units) permettant de générer des quiz de code complexe en moins de 2 secondes. Gemini ou ChatGPT ont été écartés pour ce projet à cause de leurs latences trop élevées qui cassaient l'immersion "temps réel".

### **Interface Utilisateur (UI/UX)**
- **Tailwind CSS** :
  - *Pourquoi ?* Pour implémenter le "Hacker Dark Theme" sur mesure sans s'appuyer sur des bibliothèques de composants génériques.
- **Highlight.js** :
  - *Pourquoi ?* Indispensable pour la coloration syntaxique des snippets de code générés, offrant une expérience visuelle identique à un IDE.
- **Marked.js** :
  - *Pourquoi ?* Pour parser fluidement le Markdown renvoyé par l'IA dans l'interface de jeu.

- **User_Quiz** (Pivot pour le tracking des scores)

---

## 🛡️ 4. Assurance Qualité & Gouvernance IA

Pour garantir la pérennité du projet et la fiabilité des contenus générés :

### **Règles d'Agents (Agent Rules)**
Le projet intègre une couche de gouvernance automatisée via `.agents/rules/` :
- **quality_security.md** : Interdiction stricte de secrets en dur, validation systématique des entrées utilisateur.
- **documentation.md** : Standardisation des commentaires PHP (PHPDoc obligatoire) pour une maintenance facilitée.

### **Tests Automatisés (PHPUnit)**
Une suite de tests a été mise en place pour sécuriser le cœur fonctionnel :
- **Feature Tests** : Validation des parcours de soumission de quiz et du calcul de score.
- **Unit Tests** : Tests isolés de la logique de parsing JSON/Markdown des réponses de l'IA.

### **Analyse Statique (SonarCloud)**
Le projet est surveillé par SonarCloud pour détecter les "Code Smells", les vulnérabilités et garantir un Quality Gate respecté avant chaque mise en production.

