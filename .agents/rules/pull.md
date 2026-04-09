---
trigger: when pulling code from a remote repository, or executing `git pull`
---

# Protocole de Pull & Synchronisation Sécurisée

Avant et après l'exécution d'un `git pull` (ou lors de la réception de code depuis le dépôt distant), l'agent DOIT obéir à la procédure stricte suivante. Le but est d'éviter toute perte de travail local, de gérer proprement les conflits de versionnement, et de remettre le projet en état de fonctionnement.

**Règle d'Or : Interactivité Obligatoire.** À CHAQUE étape bloquante ou action entraînant des conséquences sur l'environnement de développement, tu t'arrêtes et tu poses la question à l'utilisateur.

## 1. Vérification Avant Pull (Pre-Pull Check)
- **Vérification de l'état local (`git status`)** : Ne lance JAMAIS de `git pull` si le répertoire de travail contient des fichiers non committés qui risquent d'être écrasés (comme des erreurs sur `storage/logs/laravel.log`).
- **Interaction** : Si l'état n'est pas propre, demande à l'utilisateur : *"Des fichiers ont été modifiés localement. Veux-tu faire un Commit, utiliser `git stash` (mettre de côté), ou forcer la suppression des modifications ?"*

## 2. Détection et Résolution Interactive des Conflits
- Si le pull crée une situation de **Merge Conflict** :
  1. Identifie la liste exacte des fichiers en conflit.
  2. Lis le contenu du conflit (balises `<<<<<<< HEAD` ... `=======` ... `>>>>>>>`).
  3. **Écris un résumé clair** pour l'utilisateur, en synthétisant ce qui a changé d'un côté et de l'autre.
  4. **Ne modifie rien de ton propre chef** : Demande explicitement à l'utilisateur s'il veut conserver la version distante, la version locale, ou une fusion personnalisée pour chaque fichier concerné.

## 3. Synchronisation Post-Pull (Checkup du Projet)
Une fois le `git pull` terminé et réussi, vérifie si les fichiers majeurs d'architecture ou de dépendances ont été modifiés par le téléchargement. Si c'est le cas, **recommande fortement l'exécution de ces commandes à l'utilisateur :**
- **Dépendances PHP** : Si `composer.json` ou `composer.lock` a changé ➡️ Proposer `composer install`.
- **Dépendances Front-End** : Si `package.json` ou `package-lock.json` a changé ➡️ Proposer `npm install` puis relancer le script de build.
- **Base de Données** : Si de nouveaux fichiers sont présents dans `database/migrations/` ➡️ Proposer `php artisan migrate`.
- **Variables d'Environnement** : Si le `.env.example` a de nouvelles lignes ➡️ Avertir l'utilisateur des clés secrètes manquantes dans son `.env` local.
