import org.tsi.pipeline.Script
import org.tsi.pipeline.PipelineFactory
import org.tsi.pipeline.Pipeline
import org.tsi.pipeline.notification.NotificationSystem

node {

    Script.environment = this

	properties([
		parameters(
			[
				choice(
					choices: 'test\npreprod\nprod',
					description: 'Please enter the environment',
					name: 'TARGET_ENVIRONMENT'
				),

				string(
					defaultValue: '',
					description: 'Please enter a tag name',
					name: 'TAG_NAME'
				),

				booleanParam(
					defaultValue: false,
					description: 'Deploy ?',
					name: 'DEPLOY'
				),

				booleanParam(
					defaultValue: true,
					description: 'Run tests ?',
					name: 'RUN_TESTS'
				),

				booleanParam(
					defaultValue: false,
					description: 'Are you deploying onto a PCI ZONE?',
					name: 'PCI_ZONE'
				),

				string(
					defaultValue: 'transaction-service',
					description: 'Project name',
					name: 'PROJECT_NAME'
				),

				string(
					defaultValue: 'git@bitbucket.org:tsipayment/transaction-service.git',
					description: 'Repo url',
					name: 'GIT_URL'
				)

			]
		)
	])


	withEnv([
		'ANSIBLE_SCRIPT_PATH=infrastructure/ansible',
		'PIPELINE_TYPE=docker'
	]){

        try{

			Pipeline pipeline = PipelineFactory.ForEnvironment(params.TARGET_ENVIRONMENT);

			stage('Checkout') {
				pipeline.checkout()
			}

			env.releaseVersion = pipeline.getReleaseVersion();
			echo 'The release version is: ' + env.releaseVersion

			stage('Prepare') {
				pipeline.prepare()
			}

			stage('Build') {
				pipeline.build()
			}

			stage('Run tests') {
				if(params.RUN_TESTS) {
					pipeline.runTests()
				}
			}

			stage('Create stack') {
				if(params.DEPLOY) {
					pipeline.createStack()
				}
			}

			stage('Create artefact') {
				if(params.DEPLOY) {
					pipeline.createArtefact()
				}
			}

            stage('Publish artefact') {
                if(params.DEPLOY) {
                    pipeline.publish()
                }
            }

			stage('Deploy') {
				if(params.DEPLOY) {
					pipeline.deploy()
				}
			}

			stage('Clean up') {
                pipeline.clean()
            }

		}catch(error){
            NotificationSystem.notify(error)
		}
	}
}