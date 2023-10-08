import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import {AJAX_HEADERS} from '../data/request-helper.js';

export default class NewCitySaver extends Component {
    constructor(props) {
        super(props);
        this.state = {
            cityName: "",
        };
        //props
        this.props.setErrorMessage.bind(this);
        //functions
        this.validateTextFieldValue = this.validateTextFieldValue.bind(this);
        this.validateTextField = this.validateTextField.bind(this);
        this.saveForm = this.saveForm.bind(this);
    }

    /**
     * Szövegmezőt validálja 
     */
    validateTextFieldValue(e) {
        this.validateTextField(e.target.value)
    }
    
    /**
     * Validálja a városnév szövegmezőt és a megye inputot 
     * @param {string}  value - Az utolsó elem fade-eljen-e be, vagy sem
     * @returns {bool} 
     */
    validateTextField(value) {
        document.getElementById("errorName").innerHTML = "";
        this.props.setErrorMessage("");
        let error = false;

        if (value === "" || typeof value == "undefined") {
            document.getElementById("errorName").innerHTML = "Kötelezően kitöltendő mező";
            error = true;
        }
        if (this.props.countyId == null || typeof this.props.countyId == "undefined") {
            this.props.setErrorMessage("Megye nincs kiválasztva");
            error = true;
        }
        if (!error) {
            document.getElementById("errorName").innerHTML = "";
            return true;
        } else {
            return false;
        }

        return true;
    }

    /**
     * Elmenti a várost 
     * @param {bool}  event
     * @returns {type} 
     */
    saveForm(event) {
        event.preventDefault();
        var thisModel = this;
        if (!this.validateTextField(this.state.cityName)) {
            return;
        }
        try {
            axios.post('/api/uj-varos', {
                county_id: thisModel.props.countyId,
                name: thisModel.state.cityName
            }, {
                headers: AJAX_HEADERS,
            }).then(result => {
                if (result.data.success) {
                    this.setState({cityName: ""})
                    document.getElementById("errorName").innerHTML = "";
                    document.getElementById("cityName").value = "";
                    thisModel.props.rerenderCityList();
                } else {
                    thisModel.props.setErrorMessage("");

                    if (typeof result.data.data.name !== "undefined") {
                        document.getElementById("errorName").innerHTML = result.data.data.name;
                    }
                    if (typeof result.data.data.county_id !== "undefined") {
                        thisModel.props.setErrorMessage(result.data.data.county_id);
                    }
                }
            }).catch(function (e) {
                console.log(e);
                alert("Váratlan hiba történt a mentés során, kérlek próbáld újra később");
            });
            ;
        } catch (e) {
            console.log(e);
            alert("Hiba történt a mentés során");
        }
    }

    render() {
        return (
                <div className="row">
                    <div className="col-lg-9">
                        <input
                            placeholder="Város neve"
                            type="text"
                            name="city_name"
                            id="cityName"
                            className="form-control"
                            onBlur={this.validateTextFieldValue}
                            onChange={(item) => {
                                    this.setState({cityName: item.target.value})
                                }}
                            />
                        <div className="input-error" id={"errorName"}></div>
                    </div>
                    <div className="col-lg-3 text-right">
                        <button type="submit" className="btn btn-success" onClick={this.saveForm}>Város mentése</button>
                    </div>
                </div>
                );
    }
}

