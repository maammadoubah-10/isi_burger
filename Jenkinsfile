pipeline {
    agent any

    stages {
        stage('Cloner le projet') {
            steps {
                git branch: 'main', url: 'https://github.com/maammadoubah-10/isi_burger.git'
            }
        }

        stage('Installer les dépendances Laravel') {
            steps {
                sh 'composer install --no-dev --prefer-dist || composer install --no-dev --prefer-dist --no-cache'
                sh 'php artisan config:clear && php artisan cache:clear'
                sh 'php artisan config:cache'
            }
        }

        stage('Créer l’image Docker') {
            steps {
                sh 'docker build -t isi_burger:latest .'
            }
        }

        stage('Pousser l’image Docker') {
            steps {
                withDockerRegistry([credentialsId: 'docker-hub-credentials', url: '']) {
                    sh 'docker tag isi_burger:latest maammadoubah/isi_burger:latest'
                    sh 'docker push maammadoubah/isi_burger:latest'
                }
            }
        }

        stage('Déploiement ou test') {
            steps {
                sh 'docker run -d -p 8080:80 --name isi_burger maammadoubah/isi_burger:latest'
            }
        }
    }
}
