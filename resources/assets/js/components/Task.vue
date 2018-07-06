<template>
    <div class="container" id="app">
        <ul class="list-group">
            <li class="list-group-item" v-for="task in tasks" v-text="task"></li>
        </ul>

        <form @submit.prevent="addTask" method="post">
            <div>
                <input v-model="newTask" type="text" class="form-control" >
            </div>
                <button type="submit" class="btn btn-primary">submit</button>
        </form>
        
    </div>
</template>

<script>
    export default {
        props: ['project'],
        data() {
            return {
                tasks: [],
                newTask: ''
            }
        },
        mounted() {
            axios.get('/study/queues/projects/' + this.project + '/tasks').then(response => {
                this.tasks = response.data
            });
            window.Echo.channel('tasks').listen('TaskEvent', e =>{
                console.log('ok');
                this.tasks.push(e.task.body);
            });
        },
        methods: {
            addTask() {
                axios.post('/study/queues/projects/' + this.project + '/tasks', {body: this.newTask});
                this.tasks.push(this.newTask);
                this.newTask = '';
            }
        }
    }
</script>
