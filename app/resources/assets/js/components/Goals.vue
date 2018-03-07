<template>
	<div class="card card-default">
		<div class="card-header">
			Goals
		</div>
		<div class="card-body">
			<ul class="list-group">
				<li v-for="goal in uncompletedGoals" :key="goal.id" @click="clearGoal" class="list-item">
					{{ goal.text }}
				</li>
			</ul>
		</div>
	</div>
</template>

<script>
	export default {
		mounted() {
			// Get the goals from the server
		},

		data() {
			return {
				uncompletedGoals: []
			}
		},

		methods: {
			clearGoal() {
				
			}
		}
	}
</script>