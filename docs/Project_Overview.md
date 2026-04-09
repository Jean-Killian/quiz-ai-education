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

---

## 🏗️ 3. Architecture des Données
Le projet utilise une architecture relationnelle simple mais extensible :
- **Quizzes** (Missions)
- **Questions** (Snippets buggés)
- **Answers** (Patches correctifs)
- **User_Quiz** (Pivot pour le tracking des scores)
