import React, { useState } from 'react';
import './App.css';
import Header from './Header';
import Footer from './Footer';
import Dashboard from './Dashboard';
import Login from './Login';

function App() {
    const [user, setUser] = useState(null);

    const handleLogin = (user) => {
        setUser(user);
    };

    return (
        <div className="App">
            <Header />
            {!user ? (
                <Login onLogin={handleLogin} />
            ) : (
                <Dashboard />
            )}
            <Footer />
        </div>
    );
}

export default App;
