import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import CityModifier from './CityModifier';


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

    /**
     * Város listát újra renderelteti
     */
    reRenderCityList() {
        this.props.getCityData();
        this.changeFormToButton();
    }

    /**
     * Város módosító gombsort visszalakítja gombbá
     */
    changeButtonToForm() {
        this.setState({isButton: false});
        this.props.closeAllCityModifierWindow(this.props.cityId);
    }
    /**
     * Város módosító gombot átalakítja gombsorrá
     */
    changeFormToButton() {
        this.setState({isButton: true});
    }

    /**
     * Csak az aktuálisan használt gombsort tartsuk meg, a többit alakítsuk vissza város gombbá
     */
    componentDidUpdate(prevProps) {
        if (prevProps.closeWindows !== this.props.closeWindows) {
            if (this.props.closeWindows == this.props.cityId) {
                this.setState({isButton: false});
            } else {
                this.setState({isButton: true});

            }
        }
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
                <div className="city-list-row">
                    {formElement}
                </div>
                );
    }

}

