import {render} from '@wordpress/element';
import App from './App'; 

document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('todo-list-root');
    if (container) {
        render(<App />, container);
    }
});