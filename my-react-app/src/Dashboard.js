import React, { useState, useEffect } from 'react';
import axios from 'axios';

const Dashboard = () => {
    const [data, setData] = useState(null);

    useEffect(() => {
        // Fazer requisição GET à API Laravel
        axios.get('http://localhost:8000/api/data')
            .then(response => {
                setData(response.data);
            })
            .catch(error => {
                console.error('Houve um erro ao buscar os dados:', error);
            });
    }, []);

    const handleSubmit = (event) => {
        event.preventDefault();
        // Fazer requisição POST à API Laravel
        axios.post('http://localhost:8000/api/data', { data: 'Meu dado' })
            .then(response => {
                console.log(response.data.message);
            })
            .catch(error => {
                console.error('Houve um erro ao enviar os dados:', error);
            });
    };

    return (
        <div className="container mt-4">
            <h1>Dashboard</h1>
            <form onSubmit={handleSubmit}>
                <button type="submit" className="btn btn-primary">Enviar</button>
            </form>
            {data && <div>{data.data}</div>}
        </div>
    );
};

export default Dashboard;
