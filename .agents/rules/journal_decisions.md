---
trigger: when making structural, architectural, product, security, or deployment decisions
---

# Tenue du Journal des Décisions (ADR / Decision Log)

À CHAQUE FOIS que tu effectues un choix structurant pour le projet, tu DOIS obligatoirement consigner cette décision sous forme de journal (dans le dossier `docs/ADR/` ou un fichier markdown dédié).

**Formatage du fichier :** 
Chaque décision doit être un fichier séparé nommé selon la convention : `ADR-XXX-titre-de-la-decision.md` (ex: `ADR-001-choix-base-de-donnees.md`).

Chaque décision technique ou produit doit **strictement obéir aux critères d'acceptation suivants** afin d'être exploitable en soutenance pour expliquer les arbitrages :

1. **Titre et Statut** : Nom court de la décision et son statut actuel (*Proposé, Accepté, Déprécié, Remplacé*).
2. **Date** : Préciser la date à laquelle la décision a été prise.
3. **Auteur** : L'utilisateur (ou l'agent AI) qui a fait ces modifications et validé la décision.
4. **Contexte** : Quel est le problème initial ou le besoin produit justifiant cette décision ?
5. **Options envisagées** : Quelles étaient les alternatives ou technologies considérées (minimum 2 options lorsque c'est pertinent) avec leurs "Pros" (Avantages) et "Cons" (Inconvénients).
6. **Choix retenu et Justification** : Quelle option a été choisie et pour quelles raisons objectives ?
7. **Compromis & Conséquences** : Explicite clairement quel compromis a été accepté ou quelle conséquence ce choix implique (par exemple: "Nous acceptons une complexité d'infrastructure pour gagner en scalabilité", ou "Cette approche limite la personnalisation future mais assure un livrable pour demain").
8. **Impacts et Dépendances** *(Optionnel mais recommandé)* : L'impact sur d'autres parties du code, l'infrastructure, ou le budget.

**Périmètre obligatoire :** Les décisions consignées doivent a minima couvrir les domaines du produit, de l'architecture, de la sécurité ou du déploiement. 
Évite les choix opaques pris "au vol" : toute décision majeure doit être défendable et tracée.
