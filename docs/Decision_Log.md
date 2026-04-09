# 📜 Journal des Décisions Techniques (ADR)

Ce document trace l'historique des **décisions structurantes** prises pour le projet "Quiz AI Education". Il a vocation à expliquer "Pourquoi" certains arbitrages techniques, produit ou sécurité ont été pris afin d'éviter les remises en question futures et de faciliter la soutenance du projet.

---

## 🛠️ Modèle d'une Décision (Template)
Chaque décision suit la structure de référence MADR (Markdown Architecture Decision Records) :
1. **Contexte :** Quel était le problème ?
2. **Options :** Quelles étaient les solutions ?
3. **Choix Retenu :** La décision finale.
4. **Compromis (Conséquences) :** Ce que ce choix implique (positif/négatif).

---

## 📅 Chronologie des Arbitrages

### [ADR-001] Frontend : Intégration Tailwind CSS via CDN
- **Date :** 8-9 Avril 2026
- **Catégorie :** Déploiement / Interface
- **Contexte :** Pour la Landing Page (US07), il fallait un rendu visuel attrayant extrêmement rapidement sans casser la chaine d'intégration Laravel et sans faire attendre le framework NPM/Vite.
- **Options :**
  1. Configurer Vite avec npm install et packager les assets.
  2. Importer Tailwind via balise `<script src="cdn..."></script>`.
- **Choix Retenu :** **Option 2 (CDN).**
- **Compromis accepté :** La page charge le parseur Tailwind JS côté client (ce qui n'est pas optimal pour la web performance pure en production par rapport à un build précompilé). Ce compromis est pleinement assumé pour prioriser la *vitesse d'itération* lors du développement MVP.

### [ADR-002] Données : Les Quiz appartiennent à tous (Pas de `user_id`)
- **Date :** 9 Avril 2026
- **Catégorie :** Architecture Backend / Modélisation
- **Contexte :** Lors de la création des Entités (US13), la liberté des données s'est posée. Faut-il cloisonner les quiz générés pour que seul le créateur puisse y jouer ou les partager ?
- **Options :**
  1. Forcer la table `quizzes` avec une foreign key `owner_id`.
  2. Rendre les quiz publics et traquer uniquement les Scores `[user_id, quiz_id]` dans une table pivot.
- **Choix Retenu :** **Option 2.**
- **Compromis accepté :** Pour le MVP, la base de données est vue comme un "bac à sable partagé" pour tous les étudiants. C'est plus léger mentalement pour l'utilisateur, mais à l'avenir, si l'on veut respecter un strict principe de confidentialité pour l'étudiant, il faudra faire migrer la table pour ajouter un Auteur.

### [ADR-003] Sécurité : L'Étudiant est Créateur
- **Date :** 9 Avril 2026
- **Catégorie :** Sécurité / Produit
- **Contexte :** Qui a le droit de cliquer sur le fameux bouton "Générer avec l'IA" qui pèse potentiellement lourd sur notre consommation LLM ?
- **Options :**
  1. Restreindre via le middleware uniquement au rôle "Professeur".
  2. Démocratiser et responsabiliser l'étudiant "Utilisateur".
- **Choix Retenu :** **Option 2 (Tout étudiant authentifié).**
- **Compromis accepté :** L'avantage est l'autonomie totale (US14). L'inconvénient est le risque de spam. Il faudra anticiper à terme du Rate-Limiting (limitation de requêtes par IP) ou des crédits IA par étudiant pour ne pas exploser financièrement la facture de l'API.

### [ADR-004] Interopérabilité : Le choix de l'API REST JSON
- **Date :** 9 Avril 2026
- **Catégorie :** Architecture Route et Cloud
- **Contexte :** Comment doivent se comporter les chemins pour créer un quiz ou le soumettre (US15) alors que notre backend dispose de Blade ?
- **Options :**
  1. Envoi de formulaire classique HTTP (avec `redirect()->back()`).
  2. Couche stricte API renvoyant du format générique `JSON`.
- **Choix Retenu :** **Option 2 (API REST JSON stricte).**
- **Compromis accepté :** Demande un effort supplémentaire côté frontend (ex: Fetch JS) pour traiter la donnée asynchrone, mais garantit que l'architecture soit 100% propre, moderne, et réutilisable immédiatement si l'on veut brancher une app Mobile Flutter / React Native ou un SPA demain. C'est un gage de professionnalisme.

---

### [ADR-005] Changement de fournisseur LLM : Migration vers Groq
- **Date :** 9 Avril 2026
- **Catégorie :** Intelligence Artificielle / Performances
- **Contexte :** L'API précédemment utilisée manquait de rapidité. Le besoin en réactivité (fluidité de l'interface) a imposé la recherche d'une solution d'inférence extrêmement rapide.
- **Options :**
  1. Conserver l'API existante.
  2. Passer sur un modèle via Groq (utilisant des LPU pour une inférence à très haute vitesse) via un endpoint compatible OpenAI.
- **Choix Retenu :** **Option 2 (Groq).**
- **Compromis accepté :** Le format de réponse interne a nécessité une adaptation (passant de `candidates[0]...` au format OpenAI `choices[0].message.content`). Il faut également configurer les nouvelles variables d'environnement (`GROQ_API_KEY`).

---

> [!IMPORTANT]
> **Directive de Développement :** À chaque nouvelle crise d'architecture future (ex: Ajout d'une base NoSQL, Refonte des rôles, Stratégie de mise en cache LLM), ce journal **doit** être mis à jour !
