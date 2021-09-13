pipeline {
    agent any
    stages {
        stage('Building t3x-vuejs') {
            when { buildingTag() }
            environment {
                TER_ACCOUNT = credentials('typo3-ter-zotornit')
            }
            steps {
                echo "Building t3x-vuejs:$TAG_NAME"
                script {
//                     sh 'git log -1 --pretty=%b > /tmp/commentfile'
                    sh 'docker run -i --rm -v $WORKSPACE:/extension zotornit/t3ter-upload upload user=$TER_ACCOUNT_USR password=$TER_ACCOUNT_PSW upload_comment=-'
//                     sh 'rm /tmp/commentfile'
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
