import React from 'react';
import { createRoot } from 'react-dom/client';
import App from './App'; 

document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('todo-list-root');
    if (container) {
        const root = createRoot(container); // React 18 root
        root.render(<App />);
    }
});