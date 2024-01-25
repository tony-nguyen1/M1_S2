package fr.umontpellier.etu.donneesArborescentes;

public abstract class ElementStockage {
    protected static int basicSize;
    public abstract int size();
    public abstract String absoluteAddress();
    public abstract void ls();
}
