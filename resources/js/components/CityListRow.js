import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import CityModifier from './CityModifier';

const AJAX_HEADERS = {
    'Content-Type': 'application/json',
    //'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    'X-Requested-With': 'XMLHttpRequest',
    "Accept": "application/json",
    //'Authorization': 'Bearer ' + Laravel.apiKey,
};

export default class CityListRow extends Component {
    constructor(props) {
        /*
         * props: cityId, key, name
         */
        super(props);

        this.state = {
            isButton: true,
        };

        this.changeButtonToForm = this.changeButtonToForm.bind(this);
        this.changeFormToButton = this.changeFormToButton.bind(this);
        this.reRenderCityList = this.reRenderCityList.bind(this);

    }

    reRenderCityList() {
        this.props.getCityData();
    }

    changeButtonToForm() {
        this.setState({isButton: false});
    }
    changeFormToButton() {
        this.setState({isButton: true});
    }

    render() {
        let formElement = null;

        if (this.state.isButton) {
            formElement = <button type="submit" className="btn btn-success" onClick={this.changeButtonToForm}>{this.props.name}</button>;
        } else {
            formElement = <CityModifier 
                cityId={this.props.cityId} 
                name={this.props.name} 
                changeFormToButton={this.changeFormToButton}
                reRenderCityList={this.reRenderCityList}>
            </CityModifier>;
        }
        return (
                <div>
                    {formElement}
                
                </div>
                );
    }

}

