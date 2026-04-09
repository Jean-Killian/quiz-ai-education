---
trigger: always_on
---

# Périmètre et Limitations de l'Agent

Cette règle vise à encadrer la liberté d'action de l'agent afin d'éviter les dérives liées à des initiatives non sollicitées.

1. **Interdiction des modifications hors périmètre** : Ne modifie jamais de fichiers, d'architectures ou de configurations qui ne sont pas explicitement liés au ticket/tâche en cours. Toute refactorisation ou suppression de code "opportuniste" hors du cadre est strictement interdite.
2. **Justification des changements structurels** : Si la résolution d'une tâche exige de facto une modification structurelle (changement de version, ajout d'une librairie lourde, restructuration de la BDD), justifie l'obligation technique et attends l'accord de l'utilisateur **avant** exécution.
3. **Traçabilité stricte** : Maintiens un suivi rigoureux (via ADR de `journal_decisions.md`) et ne contourne jamais les validations humaines requises, particulièrement lors d'opérations Git destructives.
