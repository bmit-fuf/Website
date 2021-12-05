new Vue({
  el: "#app",
  data: {
		title: 'To Do',
		//To Do List Creation
  	todos: [
			{ text: 'Create Vue To Do List', done: true, id: Date.now()}, 
			{ text: 'Master All JS Frameworks', done: false, id: Date.now() + 1},
			{ text: 'World Domination', done: false, id: Date.now() + 2}
		]
  },
  methods: {
		// Add item to to do list
  	addTodo(event) {
			// Gets text from input
			const text = event.target.value
			// Pushes new to do item to list, done set to false by default
			this.todos.push({text, done: false, id: Date.now()})
			// Clears Input text
			event.target.value = ''
		},
		removeTodo(id) {
			// Removes specified item from list 
			this.todos = this.todos.filter(todo => todo.id !== id)
		},
		check(todo) {
			// set todo.done value to opposite of what it currently is
			todo.done = !todo.done
		}
  }
});

