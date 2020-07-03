import React, {useState, useRef} from 'react';
import {Button, Form, Row, Col, Tooltip, Overlay} from 'react-bootstrap';
import CompressorService from '../Service/CompressorService'

export function CompressorForm (type) {

    const regexValidation = type === "decomress" ? /(^[a-fA-F][a-fA-F0-9]+$|^[a-fA-F]+$)/ : /^[a-fA-F]+$/;
    const [inpString, setInpString] = useState("");
    const [resultString, setResultString] = useState("");
    const [showTooltip, setShowTooltip] = useState(false);
    const targetInput = useRef(null);

    function inputChange(e) {

        if (regexValidation.test(e.target.value) || e.target.value === "") {
            setInpString(e.target.value);
            setShowTooltip(false);
        } else {
            setShowTooltip(true);
        }
    }

    function clearInput() {
        setResultString("");
        setInpString("");
    }

    const getCompressed = () => {
        const data = {
            inputString: inpString
        };
        if (type === "decomress") {
            CompressorService.getDecompressed(data)
                .then(response => {
                    setResultString(response.data.decompressed);
                })
                .catch(e => {
                    console.log(e);
                });
        } else {
            CompressorService.getCompressed(data)
                .then(response => {
                    setResultString(response.data.compressed);
                })
                .catch(e => {
                    console.log(e);
                });
        }
    };

    return (
        <div style={{padding:"1em"}}>
            <Form>
                <Form.Group as={Row} controlId="formInputStr">
                    <Form.Label column sm={3}>
                        Input string
                    </Form.Label>
                    <Col sm={9}>

                        <Form.Control ref={targetInput} type="text" onChange={inputChange} value={inpString} />
                        <Overlay
                            target={targetInput.current}
                            show={showTooltip}
                            placement="bottom"
                        >
                            {props => (
                                <Tooltip id="overlay-example" {...props}>
                                    Input string must include only next chars (a,b,c,d,e,f)
                                </Tooltip>
                            )}
                        </Overlay>
                    </Col>
                </Form.Group>

                <Form.Group as={Row} controlId="formResultStr">
                    <Form.Label column sm={3}>
                        {type.charAt(0).toUpperCase() + type.slice(1)}ed String
                    </Form.Label>
                    <Col sm={9}>
                        <Form.Control type="text" disabled={true} value={resultString}/>
                    </Col>
                </Form.Group>

                <Form.Group as={Row}>
                    <Col sm={{ span: 9, offset: 3 }}>
                        <Button onClick={getCompressed} >{type.charAt(0).toUpperCase() + type.slice(1)}</Button>{' '}
                        <Button onClick={clearInput} variant="danger">Clear</Button>
                    </Col>
                </Form.Group>
            </Form>
        </div>
    );

}