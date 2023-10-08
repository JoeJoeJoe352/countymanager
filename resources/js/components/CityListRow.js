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
         * props: cityId, key, name, fadeIn
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
        this.changeFormToButton();
    }

    changeButtonToForm() {
        this.props.closeAllCityModifierExcept(this.props.cityId);
        this.setState({isButton: false});
    }
    
    changeFormToButton() {
        this.setState({isButton: true});
    }
    
    componentDidUpdate(){
        console.log(this.props.closeWindowExcept);
        console.log(this.props.cityId);
        /*if(this.props.cityId !== this.props.closeWindowExcept){
            this.changeFormToButton();
        }*/
    }

    render() {
        let formElement = null;
        let fadeInClass = this.props.fadeIn ? "btn btn-citylist fade-in" : "btn btn-citylist";
        if (this.state.isButton) {
            formElement = <button 
                type="submit" 
                className={fadeInClass}
                onClick={this.changeButtonToForm}
                >{this.props.name}</button>;
        } else {
            formElement = <CityModifier 
                cityId={this.props.cityId} 
                cityName={this.props.name} 
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

