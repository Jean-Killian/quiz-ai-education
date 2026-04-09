---
trigger: when preparing a commit, pushing code, or finalising a task
---

# Checklist de Pré-Push & Revue de Code Avancée

À CHAQUE FOIS que l'utilisateur est sur le point de commiter ou de "pusher" du code vers un dépôt distant, tu DOIS automatiquement déclencher la procédure exhaustive suivante. **Ne lance aucune commande git destructive ou d'envoi réseau sans d'abord obtenir l'accord explicite de l'utilisateur à l'étape 6.**

## Procédure Obligatoire avant un Push :

1. **Vérification des Bugs et Erreurs** :
   - Vérifie l'absence d'erreurs de syntaxe, imports non résolus, ou variables orphelines.
   - Confirme l'exécution réussie des tests existants (ex: avec `php artisan test` côté Laravel).

2. **Relecture du Code et Formattage (Clean Code)** :
   - Traque et retire méthodiquement tout reliquat de débogage (`dump()`, `dd()`, `console.log()`).
   - Supprime les blocs de code massivement commentés (code mort).
   - Suggestion de formatage : Appelle si nécessaire les linters du projet (ex: Laravel Pint, Prettier).

3. **Sécurité et Fichiers d'Environnement** :
   - **Contrôle critique :** Assure-toi absolument qu'aucun mot de passe, clé d'API, ou token secret n'est codé en dur dans les fichiers traqués.
   - Si l'application requiert de nouvelles variables, vérifie qu'elles sont documentées dans `.env.example` et non committées via un `.env`.

4. **Bonnes Pratiques Git** :
   - **Nom de la branche et Push** : Vérifie la branche courante. Si elle est nouvelle, génère dynamiquement la proposition de push via `git push --set-upstream origin <nom_branche>` (afin d'éviter les rejets "no upstream branch"). Ne push JAMAIS sur la branche `main` sans validation préalable.
   - **Conventions et Granularité des Commits** : Applique un cloisonnement strict (1 commit = 1 changement logique ou fonctionnel simple). Ne regroupe pas d'énormes modifications sans rapport dans un seul commit monolithique. Propose des messages structurés ("Conventional Commits") tels que `feat: ajoute X`, `fix: résout le bug Y`.

5. **Documentation Automatique du Travail** :
   - Mets à jour les éventuels fichiers de documentation technique (ex: `README.md`, blocs en-tête PHPDoc).
   - Au besoin, crée le journal des décisions (ADR) s'il y a eu un choix architectural structurant dans cette itération.

6. **Proposition de "Code Review" Utilisateur Finale** :
   - **Génère un récapitulatif détaillé** listant tous les fichiers réellement modifiés vs supprimés, ainsi qu'une synthèse expliquant la valeur ajoutée métier.
   - Poser explicitement la question finale : *"Voici le condensé de qualité de l'ensemble des travaux, ainsi que le message de commit suggéré. Me donnes-tu le feu vert pour valider (commit) et pousser le code (push) ?"*
