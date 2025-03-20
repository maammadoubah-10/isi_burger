pipeline {
    agent any

    environment {
        GITHUB_REPO = 'https://github.com/maammadoubah-10/mamadou_ba_burger.git'
        BRANCH = 'main'  // ✅ Changement ici
        DOCKER_IMAGE = 'maammadoubah/isi_burger'
    }

    stages {
        stage('Cloner le projet') {
            steps {
                git branch: "${BRANCH}", url: "${GITHUB_REPO}"
            }
        }

        stage('Installer les dépendances Laravel') {
            steps {
                sh 'composer install --no-dev --prefer-dist'
                sh 'php artisan config:cache'
            }
        }

        stage('Créer l’image Docker') {
            steps {
                sh 'docker build -t ${DOCKER_IMAGE}:latest .'
            }
        }

        stage('Pousser l’image Docker') {
            steps {
                withDockerRegistry([credentialsId: 'docker-hub-credentials', url: 'https://index.docker.io/v1/']) {
                    sh 'docker push ${DOCKER_IMAGE}:latest'
                }
            }
        }

        stage('Déploiement ou test') {
            steps {
                echo "Déploiement terminé !"
            }
        }
    }
}
