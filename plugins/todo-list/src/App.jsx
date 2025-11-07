import { createElement } from '@wordpress/element';
import { useState, createRoot } from '@wordpress/element';
import { Button, TextControl } from '@wordpress/components';

function App() {
	const [tasks, setTasks] = useState([]);
	const [newTask, setNewTask] = useState('');
	

	// Add a new task
	const addTask = () => {
		const trimmed = newTask.trim();
		if (!trimmed) return;
		setTasks([...tasks, { text: trimmed, done: false }]);
		setNewTask('');
	};

	// Toggle a task's completion
	const toggleTask = (index) => {
		const updated = [...tasks];
		updated[index].done = !updated[index].done;
		setTasks(updated);
	};

	// Remove a task
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
								isPrimary
								onClick={addTask}
							>
								Add Task
							</Button>
						</div>

						{/* Task list */}
						<ul className="todo-list">
							{tasks.map((task, i) => (
								<li
									key={i}
									style={{
										textDecoration: task.done ? 'line-through' : 'none',
										display: 'flex',
										justifyContent: 'space-between',
										alignItems: 'center',
										marginBottom: '4px',
									}}
								>
									<span
										onClick={() => toggleTask(i)}
										style={{ cursor: 'pointer' }}
									>
										{task.text}
									</span>
									<Button
										isDestructive
										onClick={() => removeTask(i)}
									>
										Delete
									</Button>
								</li>
							))}
						</ul>
					</div>
				</div>
			</div>
		</div>
	);
}

export default App;