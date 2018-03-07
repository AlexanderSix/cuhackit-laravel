<template>
	<div>
		<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Goal</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						<div class="form-group">
							<label for="goalInput">Add Your Goal</label>
							<input type="text" id="goalInput" class="form-control" v-model="newGoal.text" aria-label="Goal Input" placeholder="Add Your Goal">
						</div>
						<button class="btn btn-primary" @click.prevent="createGoal" data-dismiss="modal">Add Goal</button>
					</form>
				</div>
			</div>
		</div>
		</div>
		<div class="card card-default">
			<div class="card-header">
				Goals <span class="float-right"><button class="btn btn-secondary" data-toggle="modal" data-target="#createModal">Add</button></span>
			</div>
			<div class="card-body">
				<ul class="list-group">
					<li v-for="goal in uncompletedGoals" :key="goal.id" @click="clearGoal(goal)" class="list-group-item">
						{{ goal.text }}
					</li>
				</ul>
			</div>
		</div>
	</div>
</template>

<script>
	import { get } from '../helpers/api.js';
	import { post } from '../helpers/api.js';

	export default {
		mounted() {
			// Get the goals from the server
			this.getGoals();
		},

		data() {
			return {
				uncompletedGoals: [],
				newGoal: {},
			}
		},

		methods: {
			clearGoal(goal) {
				console.log("Clearing goal!");
				del('api/goals', goal)
					.then( (res) => {
						this.uncompletedGoals = this.removeGoal(goal);
					})
					.catch( (err) => {
						console.log(err);
					});
			},

			getGoals() {
				console.log("Getting goals!");
				get('api/goals')
					.then( (res) => {
						this.uncompletedGoals = res.data;
					})
					.catch( (err) => {
						console.log(err);
					});
			},

			createGoal() {
				console.log("Creating goal!");
				post('api/goals', newGoal)
					.then( (res) => {

					})
					.catch( (err) => {

					});
			},

			removeGoal(goal) {
				return uncompletedGoals.filter(e => e !== goal);
			}

		}
	}
</script>