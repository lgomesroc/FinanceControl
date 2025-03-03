import React, { useState, useEffect } from 'react';
import axios from 'axios';
import ReCAPTCHA from 'react-google-recaptcha';

const Login = ({ onLogin }) => {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [error, setError] = useState('');
    const [recaptchaValue, setRecaptchaValue] = useState('');

    useEffect(() => {
        axios.get('http://localhost:8000/generate-token')
            .then(response => {
                axios.defaults.headers.common['X-CSRF-TOKEN'] = response.data;
            })
            .catch(error => {
                console.error('Erro ao obter o token CSRF:', error);
            });
    }, []);

    const handleRecaptcha = (value) => {
        setRecaptchaValue(value);
    };

    const handleSubmit = (event) => {
        event.preventDefault();
        if (!recaptchaValue) {
            setError('Por favor, complete o reCAPTCHA.');
            return;
        }
        axios.post('http://localhost:8000/login', {
            email,
            password,
            recaptcha: recaptchaValue
        })
            .then(response => {
                onLogin(response.data.user);
            })
            .catch(error => {
                setError('Falha no login. Verifique suas credenciais e tente novamente.');
            });
    };

    return (
        <div className="container mt-4">
            <h1>Login</h1>
            {error && <p className="text-danger">{error}</p>}
            <form onSubmit={handleSubmit}>
                <div className="form-group">
                    <label>Email</label>
                    <input
                        type="email"
                        className="form-control"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                    />
                </div>
                <div className="form-group">
                    <label>Password</label>
                    <input
                        type="password"
                        className="form-control"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                    />
                </div>
                <ReCAPTCHA
                    sitekey="6LfyyeMqAAAAAGyrdZq7mVOhBwtANUH6wKlj3tWR"
                    onChange={handleRecaptcha}
                />
                <button type="submit" className="btn btn-primary">Login</button>
            </form>
        </div>
    );
};

export default Login;
