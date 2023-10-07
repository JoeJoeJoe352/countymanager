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

export default class CityList extends Component {
    constructor(props) {
        super(props);

        this.state = {
            cityName: "",
        };
        this.validateTextFieldValue = this.validateTextFieldValue.bind(this);
        this.validateTextField = this.validateTextField.bind(this);
        this.saveForm = this.saveForm.bind(this);
    }

    componentDidUpdate() {
console.log("asd");
    }

    validateTextFieldValue(e) {
        this.validateTextField(e.target.value)
    }
    validateTextField(value) {
        if (value === "" || typeof value == "undefined") {
            document.getElementById("error-list-name").innerHTML = "Kötelezően kitöltendő mező";
            return false;
        } else {
            document.getElementById("error-list-name").innerHTML = "";
            return true;
        }
    }

    saveForm(event) {
        event.preventDefault();
        if (!this.validateTextField(this.state.cityName)) {
            return;
        }
        axios.post('/api/uj-varos', {
            county_id: this.props.countyId,
            name: this.state.cityName
        }, {
            headers: AJAX_HEADERS,
        })
                .then(result => {
                    let dropdownData = [];
                    result.data.data.forEach(function (apiData, index) {
                        dropdownData.push({value: apiData.id, label: apiData.name});
                    });

                    thisModel.setState({counties: dropdownData});
                });
    }

    render() {
        return (
                <div>
                    CityLista
                
                </div>
                );
    }

}

