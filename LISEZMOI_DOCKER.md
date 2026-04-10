# 🐳 Documentation Docker & Déploiement Local

Cette documentation est destinée aux étudiants ou démonstrateurs qui souhaitent lancer le projet **Quiz AI Education** rapidement à l'aide de Docker Compose. L'environnement orchestre automatiquement le backend Laravel, le front-end précompilé et une base de données isolée MySQL 8.0.

## 📋 Prérequis

- [Docker](https://docs.docker.com/get-docker/) et [Docker Compose](https://docs.docker.com/compose/install/) installés.
- Assurez-vous d'avoir obtenu votre clé d'API Mistral AI, primordiale pour la génération des Quiz.

---

## ⚙️ Configuration (Variables d'environnement)

L'image est conçue pour fonctionner avec des valeurs par défaut pour un poste en local. Toutefois, si vous disposez d'un fichier `.env` à la racine de votre projet, il sera automatiquement pris en compte.

### Variables Explicites (Incluses dans Compose) :
Les paramètres critiques orientés base de données et environnement sont directement définis dans `docker-compose.yml` :
- `DB_CONNECTION=mysql`
- `DB_HOST=db` (qui référence le second conteneur interne)
- `DB_PORT=3306`
- `DB_DATABASE=quiz_db` (identifiant: `quiz_user` / `quiz_password`)

### ⚠️ Variable Attendue :
Vous devrez renseigner votre clé secrète Mistral AI dans un fichier `.env` local pour permettre à l'IA de fonctionner de cette manière classique :
>`MISTRAL_API_KEY=votre_cle_api_ici`

---

## 🚀 Lancement (Démarrage du projet MVP)

Pour construire l'image exécutable locale et lancer les services d'arrière-plan (l'Application et la Base de Données) :

```bash
docker-compose up -d --build
```
*Le paramètre `-d` permet de nettoyer votre terminal (détaché) pendant que le service tourne en fond.*

Une fois la commande exécutée, patientez quelques dizaines de secondes lors du premier lancement (temps de configuration MySQL).
Ensuite, l'application est accessible sur :
👉 **http://localhost:8080**

### Initialisation de la BDD (Premier lancement)

La base de données est vide à la création. Lancez les migrations pour créer toutes les tables :
```bash
docker compose exec app php artisan migrate:fresh --force
```
*`migrate:fresh` supprime toutes les tables existantes et les recrée proprement. Idéal pour un premier lancement ou une remise à zéro.*

---

## 🛑 Arrêt des Services

Une fois l'utilisation ou la démonstration terminée, vous pouvez stopper tous les conteneurs et libérer le port local avec la commande :

```bash
docker-compose down
```
*Note : Cette commande arrête les conteneurs mais **conserve** les données persistantes des volumes internes au projet. Pour détruire et purger la base de données locale (Reset complet de l'environnement), vous pouvez utiliser le drapeau supplémentaire : `docker-compose down -v`*
