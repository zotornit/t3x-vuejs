pipeline {
    agent any
    stages {
        stage('Building t3x-vuejs') {
            when { buildingTag() }
            environment {
                TER_ACCESS_TOKEN = credentials('typo3-zotornit-ter-access-token')
            }
            steps {
                echo "Building t3x-vuejs:$TAG_NAME"
                script {
                    docker.withRegistry('https://registry9.de:5000', 'robo-jenkins-docker-publish') {
                        docker
                            .image('registry9.de:5000/zotornit-typo3-terupload:latest')
                            .withRun('-v $WORKSPACE:/extension  -e TER_ACCESS_TOKEN=$TER_ACCESS_TOKEN -e TAG_NAME=$TAG_NAME') { c ->
                            }
                    }
                }
            }
        }
    }

    environment {
        EMAIL_TO = "tp@zotorn.de"
    }
    post {
//             always {
//             }
        success {
            emailext (body: 'Check console output at $BUILD_URL to view the results. \n\n ${CHANGES} \n\n -------------------------------------------------- \n${BUILD_LOG, escapeHtml=false}',
                      to: "${EMAIL_TO}",
                      subject: 'Build success: $PROJECT_NAME - #$BUILD_NUMBER')

        }
        failure {
            emailext (body: 'Check console output at $BUILD_URL to view the results. \n\n ${CHANGES} \n\n -------------------------------------------------- \n${BUILD_LOG, escapeHtml=false}',
                      to: "${EMAIL_TO}",
                      subject: 'Build FAILURE: $PROJECT_NAME - #$BUILD_NUMBER')
        }
        unstable {
            emailext (body: 'Check console output at $BUILD_URL to view the results. \n\n ${CHANGES} \n\n -------------------------------------------------- \n${BUILD_LOG, escapeHtml=false}',
                      to: "${EMAIL_TO}",
                      subject: 'Jenkins build UNSTABLE: $PROJECT_NAME - #$BUILD_NUMBER')
        }
        changed {
            emailext (body: 'Check console output at $BUILD_URL to view the results. \n\n ${CHANGES} \n\n -------------------------------------------------- \n${BUILD_LOG, escapeHtml=false}',
                      to: "${EMAIL_TO}",
                      subject: 'Jenkins build CHANGED back to normal: $PROJECT_NAME - #$BUILD_NUMBER')
        }
    }
}
