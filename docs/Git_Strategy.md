# 🐙 Stratégie Git et Règles d'Intégration (GitHub Flow)

Ce document fige les règles de collaboration sur le repository de Quiz AI Education (US17). Il est à respecter scrupuleusement par tout développeur, intégrateur ou Agent IA agissant sur le code base. La discipline sur Git évite le chaos lors de l'intégration, protège la branche de référence et permet une industrialisation saine.

---

## 1. La Topologie des Branches
L'application s'appuie sur une structure dite "Trunk-based / GitHub flow" simplifié avec des branches isolées pour chaque tâche.

- **La Branche de Référence (`main`) :**
  C'est le *Trunk*. **Son état doit toujours être stable et compilable.** 
  > [!CAUTION]
  > **Règle n°1 :** Il est strictement interdit de faire un `git commit` ou `git push` directement sur la branche `main`. La branche *doit* être configurée comme "Protected Branch" sur GitHub (Settings > Branches) pour refuser les push directs.

- **Les Branches de Travail (Feature Branches) :**
  Pour toute nouvelle tâche (ex: User Story), une branche temporaire est coupée depuis un `main` propre.
  - Nomenclature : `[type]/[identifiant]-[description-courte]`
  - Exemple pour la US07 : `feat/us07-landing-page` ou simplement `us07/landing-page`
  - *Types autorisés :* `feat/`, `fix/`, `docs/`, `chore/`.

---

## 2. Le Workflow de Collaboration (Cycle de vie d'une PR)

Le processus d'intégration est la clé de voûte de cette stratégie :

1. **Isolation :** Je me place sur `main`, je fais un `git pull`, et je crée ma branche us/XX.
2. **Développement :** J'effectue mes modifications de code.
3. **Commits Atomiques :** Je sauvegarde mes étapes avec un *Commit Conventional* par cible (ex: `feat: ajout de la route post`, puis `docs: maj de la doc api`). Les messages de commits à rallonge cachant 3 modifications sans rapports sont à bannir.
4. **Demande d'Intégration :** Je pousse ma branche vers GitHub (`git push -u origin ma-branche`) et j'ouvre une **Pull Request (PR)** pointant vers `main`.

---

## 3. Règles de Revue (Code Review / Auto-revue)

Personne ne fusionne seul "à l'aveugle". La revue limite de moitié l'arrivée de régressions ou de bugs techniques.

- **Auto-Revue Obligatoire :**
  Avant d'affecter un relecteur (ou *Reviewer*), le créateur de la Pull Request se doit de réaliser une auto-revue minutieuse.
  Sur GitHub, allez dans l'onglet *Files changed* de votre propre PR et posez-vous ces questions :
  - *Ai-je laissé des bouts de code mort (ex: `console.log()` ou `dd()`) ?*
  - *Ma modélisation impacte-elle l'API JSON prévue ?*
  - *Mes types et variables sont-ils bien nommés ?*

- **Validation par Paires :**
  Dans la mesure du possible en projet étudiant, une PR doit être lue, critiquée constructivement et validée (**Approuvée**) par au moins un autre équipier avant toute fusion.

---

## 4. Règle de Fusion ("Merge")

Une fois la PR validée visuellement et technique (ex: passage au vert des requêtes de tests d'API si ajoutées) :
- Utiliser impérativement la méthode **"Squash and Merge"** de GitHub. 
- *Pourquoi ?* Cela condensera tout notre passif de brouillons locaux (les *"fix typo"*, *"oups j'ai oublié le model"*) en un seul commit atomique d'US parfait et pro sur l'arbre de `main`. Le projet reste propre et auditable en soutenance.
