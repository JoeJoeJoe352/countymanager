import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import CityListRow from './CityListRow';
import {AJAX_HEADERS} from '../data/request-helper.js';

export default class CityModifier extends Component {

    constructor(props) {
        super(props);
        this.state = {
            cityName: this.props.cityName,
        };
        this.updateCity = this.updateCity.bind(this);
        this.deleteCity = this.deleteCity.bind(this);
        this.validateTextFieldValue = this.validateTextFieldValue.bind(this);
        this.getErrorDivId = this.getErrorDivId.bind(this);
    }

    /**
     * Kliens oldali validálja a városnév inputot 
     * @returns {bool} 
     */
    validateTextFieldValue() {
        document.getElementById(this.getErrorDivId()).innerHTML = "";
        if (this.state.cityName === "" || typeof this.state.cityName == "undefined") {
            document.getElementById(this.getErrorDivId()).innerHTML = "Kötelezően kitöltendő mező";
            return false;
        } else {
            return true;
        }
    }
    
    /**
     * Város nevét módosítja 
     */
    updateCity() {
        if (!this.validateTextFieldValue()) {
            return;
        }
        var thisModel = this;
        axios.put('/api/varos-modositas/' + thisModel.props.cityId, {"name": thisModel.state.cityName}, AJAX_HEADERS)
                .then(result => {
                    if (result.data.success) {
                        this.props.reRenderCityList();
                    } else {
                        if (typeof result.data.data.name !== "undefined") {
                            document.getElementById(thisModel.getErrorDivId()).innerHTML = result.data.data.name;
                        }
                    }
                }).catch(function (e) {
            alert("Váratlan hiba történt a módosítás során, kérlek próbáld újra később!");
        });
    }

    /**
     * Várost törli 
     * @returns {type} 
     */
    deleteCity() {
        var thisModel = this;
        axios.delete('/api/varos-torlese/' + thisModel.props.cityId, [], AJAX_HEADERS)
                .then(result => {
                    if (result.data.success) {
                        this.props.reRenderCityList();
                    } else {
                        alert("Váratlan hiba történt a törlés során, kérlek próbáld újra később!");
                    }
                }).catch(function (e) {
            alert("Váratlan hiba történt a törlés során, kérlek próbáld újra később!");
        });
    }

    /**
     * Hiba kiíró div ID-jával tér vissza 
     * @returns {string} 
     */
    getErrorDivId() {
        return "error-name" + this.props.id;
    }

    render() {
        return (
                <div className="row">
                    <div className="col-lg-3">
                        <input
                            placeholder="Város neve"
                            defaultValue={this.state.cityName}
                            type="text"
                            name="city_name_update"
                            id="city_name_update"
                            className="form-control"
                            onBlur={this.validateTextFieldValue}
                            onChange={(item) => {
                                    this.setState({cityName: item.target.value})
                                }}
                            />
                        <div className="input-error" id={this.getErrorDivId()}></div>
                
                    </div>
                    <div className="col-lg-3 city-manage-buttons text-right">
                        <button type="button" className="btn btn-error" onClick={this.deleteCity}>Törlés</button>
                        <button type="button" className="btn btn-success" onClick={this.updateCity}>Módosít</button>
                        <button type="button" className="btn btn-secondary" onClick={this.props.changeFormToButton}>Mégsem</button>
                    </div>
                </div>
                )
    }

}

