/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package fr.umontpellier.etu.switchapp.p1;

import java.io.Serializable;
import java.beans.*;

/**
 *
 * @author tony.nguyen@etu.umontpellier.fr
 */
public class CompteurBean implements Serializable {
    
    private int cpt;
    private boolean stop;
    private final PropertyChangeSupport propertySupport;// = new PropertyChangeSupport(this);
    
    public void setCpt(int i) { 
        int oldValue = cpt;
        this.cpt = i;
        propertySupport.firePropertyChange("cpt", oldValue,cpt);
    }
    public int getCpt() { return cpt; }
    
    public void setStop(boolean i) { stop = i; }
    public boolean getStop() { return stop; }
    
    public void start() { setStop(false); }
    public void stop() { setStop(true); }
    
    public void addPropertyChangeListener(PropertyChangeListener listener) {
        propertySupport.addPropertyChangeListener(listener);
    }
    public void removePropertyChangeListener(PropertyChangeListener listener) {
        propertySupport.removePropertyChangeListener(listener);
    }
    
    
    public CompteurBean() {
        cpt = 0;
        stop=false;
        propertySupport = new PropertyChangeSupport(this);
    }
    
    public void incr() {
        if (!stop) setCpt(getCpt()+1);
    }
    
    public void decr() {
        if (!stop) setCpt(getCpt()+1);
    }
    
    public void raz() {
        if (!stop) setCpt(0);
    }
}
