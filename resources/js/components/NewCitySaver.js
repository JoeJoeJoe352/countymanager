import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

const AJAX_HEADERS = {
    'Content-Type': 'application/json',
    //'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    'X-Requested-With': 'XMLHttpRequest',
    "Accept": "application/json",
    //'Authorization': 'Bearer ' + Laravel.apiKey,
};

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

    validateTextFieldValue(e) {
        this.validateTextField(e.target.value)
    }

    validateTextField(value) {
        document.getElementById("error-name").innerHTML = "";
        this.props.setErrorMessage("");
        let error = false;

        if (value === "" || typeof value == "undefined") {
            document.getElementById("error-name").innerHTML = "Kötelezően kitöltendő mező";
            error = true;
        }
        if (this.props.countyId == null || typeof this.props.countyId == "undefined") {
            this.props.setErrorMessage("Megye nincs kiválasztva");
            error = true;
        }
        if (!error) {
            document.getElementById("error-name").innerHTML = "";
            return true;
        } else {
            return false;
        }

        return true;
    }

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

                document.getElementById("error-name").innerHTML = "";
                document.getElementById("cityName").value = "";

                if (result.data.success) {
                    thisModel.props.rerenderCityList();
                } else {
                    thisModel.props.setErrorMessage("");

                    if (typeof result.data.data.name !== "undefined") {
                        document.getElementById("error-name").innerHTML = result.data.data.name;
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
                <div>
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
                    <div className="input-error" id={"error-name"}></div>
                
                    <button type="submit" className="btn btn-success" onClick={this.saveForm}>Város mentése</button>
                </div>
                );
    }
}

