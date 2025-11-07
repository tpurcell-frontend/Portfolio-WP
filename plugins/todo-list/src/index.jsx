import { createRoot } from 'react-dom/client';
import App from './App';

// const App = () => <h1>Hello JSX in WordPress!</h1>;

document.addEventListener('DOMContentLoaded', () => {
  const container = document.getElementById('todo-list-root');
  if (container) {
    const root = createRoot(container);
    root.render(<App />);
  }
});
