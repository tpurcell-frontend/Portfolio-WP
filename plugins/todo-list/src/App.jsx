import { useState, useEffect } from '@wordpress/element';
import { Button, TextControl } from '@wordpress/components';

function App() {
	const [tasks, setTasks] = useState([]);
	const [newTask, setNewTask] = useState('');
	
	// Load tasks from localStorage when the component mounts.
	useEffect(() => {
		const saved = localStorage.getItem('todo-list-tasks');
		if (saved) {
			try {
				setTasks(JSON.parse(saved));
			} catch {
				console.warn('Could not parse saved tasks.');
			}
		}
	}, []);

	// Save tasks to localStorage whenever they change.
	useEffect(() => {
		localStorage.setItem('todo-list-tasks', JSON.stringify(tasks));
	}, [tasks]);

	// Add a new task.
	const addTask = () => {
		const trimmed = newTask.trim();
		if (!trimmed) return;
		setTasks([...tasks, { text: trimmed, done: false }]);
		setNewTask('');
	};

	// Toggle a task's completion.
	const toggleTask = (index) => {
		const updated = [...tasks];
		updated[index].done = !updated[index].done;
		setTasks(updated);
	};

	// Remove a task.
	const removeTask = (index) => {
		setTasks(tasks.filter((_, i) => i !== index));
	};

	return (
		<div className="container">
			<div className="row">
				<div className="col-12 col-md-8">
					<div className="todo-app">
						<h2>What's next?</h2>

						{/* Input and Add button */}
						<div className="todo-input-wrapper">
							<TextControl
								value={newTask}
								onChange={setNewTask}
								placeholder="Add a new task..."
							/>
							<Button
								onClick={addTask}
							>
								Add Task
							</Button>
						</div>

						{/* Task list */}
						<ul className="todo-list">
							{tasks.map((task, i) => (
								<li key={i}>
									<span
										onClick={() => toggleTask(i)}
										style={{ 
											textDecoration: task.done ? 'line-through' : 'none',
										}}
									>
										{task.text}
									</span>
									<Button onClick={() => removeTask(i)}>Delete</Button>
								</li>
							))}
						</ul>

						{/* Hint */}
						<p className="hint-text">Click on a task to cross it off.</p>
					</div>
				</div>
			</div>
		</div>
	);
}

export default App;