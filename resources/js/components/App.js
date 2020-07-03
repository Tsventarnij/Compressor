import React, {useState} from 'react';
import ReactDOM from 'react-dom';
import {CompressorForm} from './CompressorForm';
import {Tabs, Tab} from 'react-bootstrap';

// Importing the Bootstrap CSS
import 'bootstrap/dist/css/bootstrap.min.css';

function App() {
    const [key, setKey] = useState('comress');

    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Compressor application</div>
                        <Tabs
                            id="controlled-tab-example"
                            activeKey={key}
                            onSelect={(k) => setKey(k)}
                        >
                            <Tab eventKey="comress" title="Comress">
                                {CompressorForm('comress')}
                            </Tab>
                            <Tab eventKey="decomress" title="Decomress">
                                {CompressorForm('decomress')}
                            </Tab>
                        </Tabs>

                    </div>
                </div>
            </div>
        </div>
    );
}

export default App;

if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}
